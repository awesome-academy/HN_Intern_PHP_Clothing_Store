@extends('layout')
@section('content')
<div class="main">
  <div class="content">
    <div class="section group">
      <div class="content_top">
        <div class="heading">
        </div>
        <div class="clear"></div>
      </div>
      <form action="{{ route('changePassword') }}" method="post">
      @csrf
      <table class="tblone">
        <tr>
          <span class="success">
          <x-auth-validation-errors class="mb-4" :errors="$errors" />
          </span>
        </tr>
            <tr>
              <td>MẬT KHẨU MỚI</td>
              <td>:</td>
              <td><input required type="password" name="password" id=""></td>
            </tr>
            <tr>
              <td>XÁC NHẬN MẬT KHẨU</td>
              <td>:</td>
              <td><input required type="password" name="password_confirmation" id=""></td>
            </tr>
            <td colspan="3"><input type="submit" name="update" value="UPDATE"> </td>
            </tr>
      
      </table>
      </form>
     
    </div>
  </div>
</div>
@endsection


