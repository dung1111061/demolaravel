<form id='form' action="{{ $action }}" method='POST' enctype="multipart/form-data" >
	@if ($method == 'PUT')
		@method('PUT')
	@endif
	@csrf
	<fieldset @if ($disable) disabled @endif>
	<x-adminlte-input name="name" value='{{ $user->name }}'   label="Name" placeholder="username" label-class="text-lightblue">
	    <x-slot name="prependSlot">
	    </x-slot>
	</x-adminlte-input>
	<x-adminlte-input name="email" value='{{ $user->email }}' label="Email" placeholder="example@domain" label-class="text-lightblue">
	    <x-slot name="prependSlot">
	    </x-slot>
	</x-adminlte-input>	
	<x-adminlte-input-file name="avatar" label="Avatar" label-class="text-lightblue"/>
	@if ($user->avatar)
	<div class="form-group avatar">
	<img src="{{asset( 'storage/'.$user->avatar )}}">
	</div>
	@endif
	@php
	    $config = [
	        "allowClear" => true,
	    ];
	    $list = $user->projects->map(function ($user) {
		    return $user->id;
		})->toArray();
	@endphp
	<x-adminlte-select2 id="project" name="projects[]" label="Project" label-class="text-lightblue" :config="$config" multiple>
		@foreach ($projects as $project)
	    	<option value='{{$project->id}}' @if( in_array($project->id,$list) ) selected @endif >{{$project->name}}</option>
		@endforeach	
	</x-adminlte-select2>
	<x-adminlte-select2 id="department" name="department_id"  label="Department" label-class="text-lightblue" :config="$config" >
		@foreach ($departments as $department)
	    	<option value='{{$department->id}}' @if( $user->department_id == $department->id ) selected @endif  >{{$department->name}}</option>
		@endforeach	
	</x-adminlte-select2>
		@php
			$config = [
				'onText' => $user->is_leader ? 'No' : 'Yes',
    			'offText' => $user->is_leader ? 'Yes' : 'No',
			];
		@endphp
		<x-adminlte-input-switch name="switch_leader" label='Leader' label-class="text-lightblue" :config="$config"  />
	<x-adminlte-button type='submit' class='submit' label="Submit" theme="primary" />
	</fieldset>
</form>

<style type="text/css">
	#form{

	}
	#form button.submit{
		margin: auto;
		display: block;
	}
	#form div.form-group {
		display: flex;
		flex-wrap: wrap;
	}
	#form div.form-group > label {
		flex: 50%; 
	}
	#form div.form-group > .input-group {
		flex: 50%; 
	}
	#form div.form-group > .invalid-feedback {
		margin-left: 50%;
	}
	#form  .avatar {
		margin-left: 50%;
	}
	#form  .avatar img {
		max-height: 50px;
	}
</style>
