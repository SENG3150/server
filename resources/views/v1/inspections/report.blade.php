<!DOCTYPE html>
<html>
<head>
	<title>Inspection {{ $inspection->getId() }} - Report</title>

	<link rel="stylesheet"
	      href="https://seng3150.wingmanwebdesign.com.au/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://seng3150.wingmanwebdesign.com.au/dist/app.css">
	<link rel="stylesheet" href="https://seng3150.wingmanwebdesign.com.au/dist/theme.css">

	<style>
		body {
			background-color: #FFFFFF;
		}

		.page-break {
			page-break-before: always;
		}

		thead,
		tfoot {
			display: table-row-group;
		}
	</style>
</head>
<body>
<div class="container content">
	<div class="row">
		<div class="col-xs-offset-2 col-xs-8 m-b">
			<img class="img-responsive" src="https://seng3150.wingmanwebdesign.com.au/img/logo.png"
			     alt="Joy Global">
		</div>
	</div>

	<h1 class="text-center m-b-lg">Inspection {{ $inspection->getId() }} - Report</h1>

	<div class="row m-b">
		<div class="col-xs-6">
			<dl class="dl-horizontal">
				<dt>Machine</dt>
				<dd>{{ $inspection->getMachine()->getName() }}</dd>

				<dt>Model</dt>
				<dd>{{ $inspection->getMachine()->getModel()->getName() }}</dd>

				<dt>Technician</dt>
				<dd>
					@if($inspection->getTechnician() != NULL)
						{{  $inspection->getTechnician()->getName() }}
					@else
						Not Assigned
					@endif
				</dd>

				<dt>Domain Expert</dt>
				<dd>
					@if($inspection->getScheduler() != NULL)
						{{  $inspection->getScheduler()->getName() }}
					@else
						Not Assigned
					@endif
				</dd>
			</dl>
		</div>
		<div class="col-xs-6">
			<dl class="dl-horizontal">
				<dt>Time Created</dt>
				<dd>
					@if($inspection->getTimeCreated() != NULL)
						{{  $inspection->getTimeCreated()->format('H:i D, M jS Y') }}
					@else
						Not Created
					@endif
				</dd>

				<dt>Time Scheduled</dt>
				<dd>
					@if($inspection->getTimeScheduled() != NULL)
						{{  $inspection->getTimeScheduled()->format('H:i D, M jS Y') }}
					@else
						Not Scheduled
					@endif
				</dd>

				<dt>Time Started</dt>
				<dd>
					@if($inspection->getTimeStarted() != NULL)
						{{  $inspection->getTimeStarted()->format('H:i D, M jS Y') }}
					@else
						Not Started
					@endif
				</dd>

				<dt>Time Completed</dt>
				<dd>
					@if($inspection->getTimeCompleted() != NULL)
						{{  $inspection->getTimeCompleted()->format('H:i D, M jS Y') }}
					@else
						Not Completed
					@endif
				</dd>
			</dl>
		</div>
	</div>

	<h2 class="m-b">Action Items</h2>

	<table class="table table-bordered table-middle table-transparent m-b">
		<thead>
		<tr>
			<th>Sub Assembly</th>
			<th>Test</th>
			<th>Status</th>
			<th>Issue</th>
			<th>Action</th>
			<th>Technician</th>
			<th>Time Actioned</th>
		</tr>
		</thead>
		<tbody>
		@foreach($majorAssemblies as $majorAssembly)
			<tr>
				<td class="table-header-row" colspan="7">{{ $majorAssembly->name }}</td>
			</tr>

			@foreach($majorAssembly->subAssemblies as $subAssembly)
				@foreach($subAssembly->actionItems as $actionItem)
					<tr>
						<td>{{ $subAssembly->name }}</td>
						<td>{{ $actionItem->test }}</td>
						<td>{{ $actionItem->status }}</td>
						<td>{{ $actionItem->issue }}</td>
						<td>{{ $actionItem->action }}</td>
						<td>{{ $actionItem->technician }}</td>
						<td>{{ $actionItem->timeActioned }}</td>
					</tr>
				@endforeach
			@endforeach
		@endforeach
		</tbody>
	</table>

	@foreach($majorAssemblies as $majorAssembly)
		@foreach($majorAssembly->subAssemblies as $subAssembly)
			@if(count($subAssembly->graphs) > 0)
				<h2 class="page-break m-b">{{ $subAssembly->name }}</h2>

				<div class="row">
					@foreach($subAssembly->graphs as $graph)
						<div class="col-xs-6 m-b">
							<img class="img-responsive" src="{{ $graph }}">
						</div>
					@endforeach
				</div>
			@endif
		@endforeach
	@endforeach
</div>
</body>
</html>