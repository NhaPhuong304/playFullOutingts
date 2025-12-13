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
tbody tr:hover { background-color: #f1f5f9; cursor: pointer; }
td pre { white-space: pre-wrap; word-break: break-word; margin: 0; }
</style>

<div class="main-content">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Contact Messages</h5>
        </div>
        <div class="card-body">
            <!-- Filter + Search -->
            <div class="row g-2 align-items-center mb-4">
                <div class="col-auto">
                    <select class="form-select" id="searchStatus">
                        <option value="">All</option>
                        <option value="1">Read</option>
                        <option value="0">Unread</option>
                    </select>
                </div>
                <div class="col-auto ms-auto">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search Messages...">
                </div>
            </div>
            <div id="deleteAlert" class="alert alert-success d-none" role="alert">
                Contact message deleted successfully.
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-start align-middle w-full" id="messageTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Received</th>
                            <th>Status</th>
                            <th>Reply</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $msg)
                        <tr class="@if(!$msg->read) table-warning @endif" data-id="{{ $msg->id }}">
                            <td>{{ $msg->name }}</td>
                            <td>{{ $msg->email }}</td>
                            <td><pre>{{ $msg->message }}</pre></td>
                            <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if($msg->read)
                                    <span class="badge bg-success">Read</span>
                                @else
                                    <span class="badge bg-warning text-dark">Unread</span>
                                @endif
                            </td>
                            <td>
                                @if($msg->reply)
                                    <pre class="text-muted mb-0">{{ $msg->reply }}</pre>
                                @else
                                    <span class="text-muted">Not replied</span>
                                @endif
                            </td>
                            <td class="btn-group">
                                <button class="btn btn-sm btn-outline-success replyBtn"
                                    data-id="{{ $msg->id }}"
                                    data-name="{{ $msg->name }}">
                                    Reply
                                </button>
                                <button
                                    class="btn btn-sm btn-outline-danger deleteBtn {{ !$msg->reply ? 'disabled' : '' }}"
                                    data-id="{{ $msg->id }}"
                                    data-name="{{ $msg->name }}"
                                    @if(!$msg->reply) disabled @endif
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>
<!-- Delete Contact Modal -->
<div class="modal fade" id="deleteContactModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-trash"></i> Delete Contact
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                    Are you sure you want to delete the message from
                    <strong id="deleteContactName"></strong>?
                </p>
                <p class="text-muted mt-2 mb-0">
                    This action <strong>cannot be undone</strong>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" id="confirmDeleteContactBtn" class="btn btn-danger">
                    Delete Permanently
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Message Modal -->
<div class="modal fade" id="viewMessageModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title"><i class="bi bi-envelope"></i> Message Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div><strong>Name:</strong> <span id="viewMsgName"></span></div>
        <div><strong>Email:</strong> <span id="viewMsgEmail"></span></div>
        <div class="mt-2"><strong>Message:</strong><pre id="viewMsgContent"></pre></div>
        <div class="mt-2"><strong>Received:</strong> <span id="viewMsgDate"></span></div>
        <div class="mt-2"><strong>Status:</strong> <span id="viewMsgStatus"></span></div>
        <div class="mt-2"><strong>Reply:</strong><pre id="viewMsgReply"></pre></div>
      </div>
    </div>
  </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reply to Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div><strong>To:</strong> <span id="replyTo"></span></div>
        <textarea id="replyText" class="form-control mt-2" rows="6"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="sendReplyBtn" class="btn btn-primary">Send Reply</button>
      </div>
    </div>
  </div>
</div>

<script>
const rowsPerPage = 10;
let currentPage = 1;

function filterRows() {
    const searchText = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('searchStatus').value;
    const rows = Array.from(document.querySelectorAll("#messageTable tbody tr"));

    filteredRows = rows.filter(row => {
        const name = row.cells[0].innerText.toLowerCase();
        const status = row.cells[4].querySelector('span').textContent.includes('Read') ? "1" : "0";
        const matchName = name.includes(searchText);
        const matchStatus = statusFilter === "" || status === statusFilter;
        return matchName && matchStatus;
    });

    currentPage = 1;
    paginationTable();
}

function paginationTable() {
    const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
    document.querySelectorAll("#messageTable tbody tr").forEach(r => r.style.display = "none");
    filteredRows.slice((currentPage-1)*rowsPerPage, currentPage*rowsPerPage).forEach(r => r.style.display = "");
    
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";
    for(let i=1; i<=totalPages; i++){
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.className = "btn btn-sm btn-outline-primary mx-1" + (i===currentPage?" active":"");
        btn.onclick = () => { currentPage=i; paginationTable(); };
        pagination.appendChild(btn);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    filterRows();
    document.getElementById('searchInput').addEventListener('input', filterRows);
    document.getElementById('searchStatus').addEventListener('change', filterRows);

    // Reply modal
    let currentReplyId = null;
    const replyModalInstance = new bootstrap.Modal(document.getElementById('replyModal'));
    document.querySelectorAll('.replyBtn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.stopPropagation();
            currentReplyId = btn.dataset.id;
            document.getElementById('replyTo').textContent = btn.dataset.name;
            document.getElementById('replyText').value = '';
            replyModalInstance.show();
        });
    });

    document.getElementById('sendReplyBtn').addEventListener('click', () => {
        const reply = document.getElementById('replyText').value.trim();
        if(!currentReplyId || !reply) return alert('Message or reply empty');

        fetch(`/admin/contact/${currentReplyId}/reply`, {
            method: 'POST',
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}',
                'X-Requested-With':'XMLHttpRequest'
            },
            body: JSON.stringify({ reply })
        })
        .then(r=>r.json())
        .then(js=>{
            if(js.success){
                const row = document.querySelector(`tr[data-id="${currentReplyId}"]`);
                if(row){
                    // Update status badge
                    row.cells[4].innerHTML = `<span class="badge bg-success">Read</span>`;
                    // Update reply column
                    row.cells[5].innerHTML = `<pre class="text-muted mb-0">${reply}</pre>`;
                }
                alert('Reply sent!');
                replyModalInstance.hide();
            } else alert(js.message||'Failed to send reply');
        }).catch(()=>alert('Failed to send reply'));
    });

    // View message on row click
    document.querySelectorAll("#messageTable tbody tr").forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("viewMsgName").textContent = row.cells[0].innerText;
            document.getElementById("viewMsgEmail").textContent = row.cells[1].innerText;
            document.getElementById("viewMsgContent").textContent = row.cells[2].innerText;
            document.getElementById("viewMsgDate").textContent = row.cells[3].innerText;
            document.getElementById("viewMsgStatus").textContent = row.cells[4].querySelector('span').textContent;
            document.getElementById("viewMsgReply").textContent = row.cells[5].innerText;
            new bootstrap.Modal(document.getElementById("viewMessageModal")).show();
        });
    });
    let deleteContactId = null;
const deleteModal = new bootstrap.Modal(
    document.getElementById('deleteContactModal')
);

// Mở modal khi bấm Delete
document.querySelectorAll('.deleteBtn').forEach(btn => {
    btn.addEventListener('click', e => {
        e.stopPropagation(); // không trigger view modal
        deleteContactId = btn.dataset.id;
        document.getElementById('deleteContactName').textContent = btn.dataset.name;
        deleteModal.show();
    });
});

// Confirm delete
document.getElementById('confirmDeleteContactBtn').addEventListener('click', () => {
    if (!deleteContactId) return;

    fetch(`/admin/contact/${deleteContactId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Xóa row khỏi table
            document
                .querySelector(`tr[data-id="${deleteContactId}"]`)
                ?.remove();

            deleteModal.hide();

            // Hiện alert
            const alertBox = document.getElementById('deleteAlert');
            alertBox.classList.remove('d-none');

            // Auto hide sau 3s
            setTimeout(() => {
                alertBox.classList.add('d-none');
            }, 3000);
        } else {
            alert(data.message || 'Delete failed');
        }
    })

    .catch(() => alert('Server error'));
});
});
</script>
@endsection
