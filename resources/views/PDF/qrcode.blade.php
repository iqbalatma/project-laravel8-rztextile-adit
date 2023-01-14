<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    body {
      width: 80mm;
      height: 80mm;
      background-color: red;
    }

    .box {
      width: 80mm;
      height: 80mm;
      margin: 0px;
      padding: 0px;
      border: 2px solid black;
    }
  </style>
</head>

<body>
  @for($i=0; $i<$copies; $i++) <div class="box">
    <img src="storage/images/qrcode/38c5888e8492a899.png" alt="" srcset="">
    </div>
    @endfor
</body>

</html>