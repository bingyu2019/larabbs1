@extends('layouts.app')
@section('title','注册成功')

@section('content')
  <h1>恭喜您！注册成功！成为本站第 {{ Auth::user()->id }} 位注册会员</h1>
@endsection
