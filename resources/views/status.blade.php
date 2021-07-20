@extends(config('heartbeat.layout','layouts.app'))

@section('content')
<div class="container">

  <section class="section">
    <h1 class="title is-1">Status</h1>
    @if ($schedule_ok)
      <h2 class="title is-3">
        <span class="has-text-success">✓</span> Schedule is ok!
      </h2>
    @else
      <h2 class="title is-3">
        <span class="has-text-danger">✘</span> Schedule is not ok!
      </h2>
    @endif

    <p>
      @if (is_null($last_schedule))
        <span class="has-text-danger">✘</span> No record of last schedule heartbeat.
      @else
        @if ($schedule_ok)
          <span class="has-text-success">✓</span>
        @else
          <span class="has-text-danger">✘</span>
        @endif
        Last schedule heartbeat was {{ $last_schedule->toDateTimeString() }} - {{ $last_schedule->diffForHumans() }}
      @endif
    </p>
  </section>

  <section class="section">
    @if ($queue_ok)
      <h2 class="title is-3">
        <span class="has-text-success">✓</span> Queue is ok!
      </h2>
    @else
      <h2 class="title is-3">
        <span class="has-text-danger">✘</span> Queue is not ok!
      </h2>
    @endif

    <p>
      @if (is_null($last_queue))
        <span class="has-text-danger">✘</span> No record of last queue heartbeat.
      @else
        @if($queue_ok)
          <span class="has-text-success">✓</span>
        @else
          <span class="has-text-danger">✘</span>
        @endif
        Last queue heartbeat was {{ $last_queue->toDateTimeString() }} - {{ $last_queue->diffForHumans() }}
      @endif
    </p>

    @if ($job)
      <p>
        <span class="has-text-success">✓</span> Next job is scheduled for {{ \Carbon\Carbon::createFromTimestampUTC($job->available_at)->toDateTimeString() }} - {{ \Carbon\Carbon::createFromTimestampUTC($job->available_at)->diffForHumans() }}
      </p>
    @else
      <p>
        <span class="has-text-danger">✘</span> There is no heartbeat job in the queue. Try: <code>php artisan heartbeat</code>
      </p>
    @endif
  </section>
</div>

@endsection
