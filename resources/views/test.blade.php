<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
            </tr>
        </tfoot>
    </table>

    <script>
        $(document).ready(function() {

            // DataTable
            var empTable = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getData') }}"
                },
                columns: [{
                        data: 'nama'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'jenis_kelamin'
                    }
                ]
            });

        });
    </script>
</body>

</html>
