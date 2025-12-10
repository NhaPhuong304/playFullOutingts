@extends('admin.dashboard')
@section('page-title', 'Contact')

@section('content')
<style>
.category-thumb {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    cursor: pointer;
}
.category-thumb:hover {
    transform: scale(1.1);
    z-index: 10;
    position: relative;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}
</style>

<main class="p-6">
	<h1 class="text-2xl font-bold mb-4">Contact Messages</h1>

	@if($messages->isEmpty())
		<div>No contact messages yet.</div>
	@else
		<div class="table-responsive">
			<table class="table table-bordered table-hover text-start align-middle w-full">
				<thead class="table-light">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Message</th>
						<th style="width:140px">Received</th>
						<th style="width:140px">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($messages as $msg)
					<tr class="@if(!$msg->read) table-warning @endif" data-id="{{ $msg->id }}">
						<td class="p-2 align-top">{{ $msg->name }}</td>
						<td class="p-2 align-top">{{ $msg->email }}</td>
					<td class="p-2 align-top"><pre class="mb-0">{{ $msg->message }}</pre></td>
					<td class="p-2 align-top">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
						<td class="p-2 align-top">
							<button class="btn btn-sm btn-outline-success replyBtn ms-2" data-id="{{ $msg->id }}" data-email="{{ $msg->email }}" data-name="{{ $msg->name }}">Reply</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="mt-4">
			{{ $messages->links() }}
		</div>
	@endif

	<script>
		(function(){
				// Reply modal setup
				const modalHtml = `
				<div id="replyModal" class="modal" tabindex="-1" style="display:none;">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Reply to message</h5>
				        <button type="button" class="btn-close" data-close="true"></button>
				      </div>
				      <div class="modal-body">
				        <div><strong>To:</strong> <span id="replyTo"></span></div>
				        <textarea id="replyText" class="form-control mt-2" rows="6"></textarea>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-close="true">Close</button>
				        <button type="button" id="sendReplyBtn" class="btn btn-primary">Send Reply</button>
				      </div>
				    </div>
				  </div>
				</div>
				`;
				document.body.insertAdjacentHTML('beforeend', modalHtml);
				const replyModal = document.getElementById('replyModal');
				const replyToEl = document.getElementById('replyTo');
				const replyTextEl = document.getElementById('replyText');
				const sendReplyBtn = document.getElementById('sendReplyBtn');
				let currentReplyId = null;

				function showModal(){ replyModal.style.display = 'block'; }
				function closeModal(){ replyModal.style.display = 'none'; replyTextEl.value = ''; currentReplyId = null; }
				document.addEventListener('click', function(e){ if(e.target.dataset && e.target.dataset.close) closeModal(); });

				sendReplyBtn.addEventListener('click', function(){
					if(!currentReplyId) return alert('No message selected');
					const token = '{{ csrf_token() }}';
					fetch(`/admin/contact/${currentReplyId}/reply`, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': token,
							'X-Requested-With': 'XMLHttpRequest'
						},
						body: JSON.stringify({ reply: replyTextEl.value })
					}).then(r => r.json()).then(js => {
						if(js && js.success){
							// remove the row from the table after successful reply
							const row = document.querySelector(`tr[data-id="${currentReplyId}"]`);
							if(row) row.remove();
							alert('Reply sent and row removed');
							closeModal();
						} else {
							alert(js && js.message ? js.message : 'Failed to send reply');
						}
					}).catch(err => { console.error(err); alert('Failed to send reply'); });
				});

				// open modal on reply button
				document.addEventListener('click', function(e){
					const btn = e.target.closest('.replyBtn');
					if(!btn) return;
					currentReplyId = btn.dataset.id;
					// Do not display the email in the modal to preserve privacy
					showModal();
				});

				
			// mark/unmark feature removed — no JS handler necessary
		})();
	</script>
</main>
@endsection