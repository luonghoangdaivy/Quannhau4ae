@extends('master')
@section('content')

<style>
  body {
    background: #1c1c1c; /* nền tối như quán nhậu buổi tối */
    color: #fff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .inner-header {
    background: url('/images/bar-bg.jpg') center center/cover no-repeat;
    padding: 30px 0;
    color: #ffda79; /* vàng nhạt như ánh đèn */
    text-shadow: 1px 1px 2px #000;
  }

  .inner-title {
    font-size: 32px;
    font-weight: bold;
    color: #ffda79;
  }

  .beta-breadcrumb a {
    color: #fff;
    text-decoration: none;
  }

  .beta-breadcrumb span {
    color: #ffda79;
  }

  #content {
    background: rgba(0,0,0,0.7);
    padding: 40px 20px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(255, 255, 0, 0.4);
    margin-top: 30px;
  }

  h4 {
    color: #ffda79;
    text-align: center;
    font-size: 28px;
    margin-bottom: 30px;
    text-shadow: 1px 1px 2px #000;
  }

  .form-block {
    margin-bottom: 20px;
  }

  .form-block label {
    display: block;
    margin-bottom: 5px;
    color: #ffcc66;
    font-weight: bold;
  }

  .form-block input {
    width: 100%;
    padding: 10px 15px;
    border: none;
    border-radius: 10px;
    background: #333;
    color: #fff;
    font-size: 16px;
  }

  .form-block input:focus {
    outline: none;
    background: #444;
    box-shadow: 0 0 10px #ffda79;
  }

  .btn-primary {
    width: 100%;
    padding: 12px;
    background: linear-gradient(45deg, #ff9900, #ffcc33);
    border: none;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #1c1c1c;
    cursor: pointer;
    transition: 0.3s;
  }

  .btn-primary:hover {
    background: linear-gradient(45deg, #ffcc33, #ff9900);
    box-shadow: 0 0 15px #ffcc33;
  }

  .text-center {
    margin-top: 20px;
    color: #ffcc66;
  }

  .text-center a {
    color: #ff9900;
    font-weight: bold;
    text-decoration: none;
  }

  .text-center a:hover {
    text-decoration: underline;
  }

  /* Responsive */
  @media (max-width: 768px) {
    #content {
      margin-top: 10px;
      padding: 20px 15px;
    }

    h4 {
      font-size: 24px;
    }
  }
</style>

<div class="inner-header">
  <div class="container">
    <div class="pull-left">
      <h6 class="inner-title">Đăng nhập</h6>
    </div>
    <div class="pull-right">
      <div class="beta-breadcrumb">
        <a href="index.html">Home</a> / <span>Đăng nhập</span>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<div class="container">
  <div id="content">
    <form action="login" method="post" class="beta-form-checkout">
      <div class="row">
        @csrf
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <h4>Đăng nhập</h4>
          <div class="space20">&nbsp;</div>

          <div class="form-block">
            <label for="email">Email address*</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form-block">
            <label for="password">Password*</label>
           <input type="password" id="password" name="password" required>
          </div>
          <div class="form-block">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </form>
    <p class="text-center">Nếu chưa có tài khoản vui lòng <a href="/register">Đăng ký</a>!</p>
  </div> <!-- #content -->
</div>
@endsection
