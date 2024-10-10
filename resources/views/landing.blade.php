<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Skrining Kesehatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	  <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet">
</head>
<body class="badan">
  <div id="pop-up">
    <div class="mbegin px-3">
      <h4 class="text-center mt-3">Login Skrining Kesehatan <br>Sekolah Budi Bakti</h4>
      <p class="line-middle"><span>Quick Sing Up</span></p>

      <div class="text-center mt-3">
        <a href="{{ route('siswa.login') }}"> <button class="btn btn-warning me-2 tombol"><h2>Login Siswa</h2></button> </a>
        <a href="{{ route('staff.login') }}"> <button class="btn btn-warning ms-2 tombol"><h2>Login Admin</h2></button></a>
      </div>
    </div>
  </div>
</body>

</html>