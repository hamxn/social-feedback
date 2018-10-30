<div class="box box-default">
<!--     <div class="box-header with-border">
        <h3 class="box-title"> </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div> -->

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th width="160px">{{ trans('app.board.pref') }}</th>
                    <th width="120px">{{ trans('app.board.open') }}</th>
                    <th width="120px">{{ trans('app.board.in_progress') }}</th>
                    <th width="120px">{{ trans('app.board.reject') }}</th>
                    <th width="120px">{{ trans('app.board.resolved') }}</th>
                    <th width="120px">{{ trans('app.board.total') }}</th>
                </tr>
                @foreach($issues as $issue)
                <tr>
                    <td>{{ $issue['name'] }}</td>
                    <td>{{ $issue['open'] }}</td>
                    <td>{{ $issue['inprogress'] }}</td>
                    <td>{{ $issue['reject'] }}</td>
                    <td>{{ $issue['resolved'] }}</td>
                    <td>{{ $issue['total'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>