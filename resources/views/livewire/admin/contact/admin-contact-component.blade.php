<div>
  <div class="card">
    <div class="card-header">
      Thông tin liên hệ
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="bg-info text-white">
            <tr>
              <th>STT</th>
              <th>Tên</th>
              <th>Email</th>
              <th>SĐT</th>
              <th>Tin nhắn</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($contacts as $key => $contact)

              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->comment }}</td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>
