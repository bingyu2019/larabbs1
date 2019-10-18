@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card ">
        <div class="card-body">
          <div class="text-center">
            作者：{{ $topic->user->name }}
          </div>
          <hr>
          <div class="media">
            <div align="center">
              <a href="{{ route('users.show', $topic->user->id) }}">
                <img class="thumbnail img-fluid" src="{{ $topic->user->avatar }}" width="300px" height="300px">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card ">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $topic->title }}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $topic->created_at->diffForHumans() }}
            ⋅
            <i class="far fa-comment"></i>
            {{ $topic->reply_count }}
          </div>

          <div class="topic-body mt-4 mb-4">
            {!! $topic->body !!}
          </div>

          @can('update', $topic)
            <div class="operate">
              <hr>
              <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-outline-secondary btn-sm" role="button">
                <i class="far fa-edit"></i> 编辑
              </a>
        {{--      <form action="{{ route('topics.destroy', $topic->id) }}" method="post"
                    style="display: inline-block;"
                    onsubmit="return confirm('您确定要删除吗？');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                  <i class="far fa-trash-alt"></i> 删除
                </button>
              </form>--}}

              {{-- 优化删除按钮 --}}
              <button class="btn btn-outline-secondary btn-sm btn-del-address" type="button" data-id="{{ $topic->id }}"><i class="far fa-trash-alt"></i>删除</button>

            </div>
          @endcan

        </div>
      </div>


      {{-- 用户回复列表 --}}
      <div class="card topic-reply mt-4">
        <div class="card-body">
          @includeWhen(Auth::check(),'topics._reply_box', ['topic' => $topic])
          @include('topics._reply_list', ['replies' => $topic->replies()->with('user', 'topic')->recent()->paginate()])
        </div>
      </div>


    </div>
  </div>
@stop


@section('scripts')
  <script>
      $(document).ready(function() {
          // 删除按钮点击事件
          $('.btn-del-address').click(function() {
              // 获取按钮上 data-id 属性的值，也就是地址 ID
              var id = $(this).data('id');
              // 调用 sweetalert
              swal({
                  title: "您确认要删除此帖？",
                  icon: "warning",
                  buttons: ['取消', '确定'],
                  dangerMode: true,
              })
                  .then(function(willDelete) { // 用户点击按钮后会触发这个回调函数
                      // 用户点击确定 willDelete 值为 true， 否则为 false
                      // 用户点了取消，啥也不做
                      if (!willDelete) {
                          return;
                      }
                      // 调用删除接口，用 id 来拼接出请求的 url
                      axios.delete('/topics/' + id)
                          .then(function (data) {
                              swal({
                                  title: "删除成功？",
                                  icon:"success"
                              })
                                  .then(function () {
                                      window.location.href="/topics";
                                  })
                              // 请求成功之后重新加载页面
                              // location.reload();
                              // window.location.href="/";
                          });
                  });
          });
      });
  </script>
@endsection













