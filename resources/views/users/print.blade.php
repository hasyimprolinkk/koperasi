<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Koperasi Reza Jaya</title>
    <style>
        @page{
            margin: 2.5cm 2.5cm 2.5cm 2.5cm;
        }

        .table, .bordir {
            border: 1px solid black;
            border-collapse: collapse;
        }
    
        hr.solid {
        border-top: 2px solid #000000;
        }

        #data{
            width: 100%;
        }

    </style>
    </head>

<body>

    <table>
        <tr>
            <!-- <td><img src="" width="80px" class="mr-3" alt=""></td> -->
            <td>
                <div style="text-align: center;">
                    <h1 style="margin-bottom: 15px;">Aplikasi Koperasi Reza Jaya</h1>
                </div>
            </td>
        </tr>
    </table>
    <hr class="solid">
    <div>
            <h4 style="margin-top: 4px; margin-bottom: -15px;">List Pegawai Koperasi</h4>
            <br>
        </div>
        <hr class="solid">
        <br>
        <table style="width: 100%;" cellpadding="5" class="table">
            <thead>    
                <tr>
                    <th class="bordir" scope="col">No</th>
                    <th class="bordir">Nama</th>
                    <th class="bordir">Email</th>
                    <th class="bordir">Roles</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($user as $usr=>$u) : ?>
                <tr>
                    <td class="bordir">{{$usr+1}}</td>
                    <td class="bordir">{{$u->name}}</td>
                    <td class="bordir">{{$u->email}}</td>
                    <td class="bordir">{{$u->roles}}</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</body>

</html>