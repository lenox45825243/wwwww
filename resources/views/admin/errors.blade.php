@if ($errors->any())
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="alert alert-danger">
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			    </div>
    		</div>
    	</div>
    </div>
@endif
