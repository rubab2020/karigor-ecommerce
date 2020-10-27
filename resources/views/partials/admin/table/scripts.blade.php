@section('scripts')
<!-- js for toggle -->
<script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>
<!-- Required datatable js -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{asset('admin/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
<!-- Datatable init js -->
<script src="{{asset('admin/pages/datatables.init.js')}}"></script>
<script>
	// change is_active column of a vendor
	$(".vendor-activator-btn").click(function(event) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': "{{csrf_token()}}"
			}
		});
		var element = this;
		$.ajax({
			type: 'POST',
			url: "{{route('admin.vendors.toggle-activation')}}",
			data: {
				id: parseInt($(this).attr("vendor_id"))
			},
			success: function(data) {
				console.log(data);
				$(element).removeClass("btn-danger");
				$(element).removeClass("btn-success");
				if (data['new_is_active']) {
					$(element).attr("is_active", "1");
					$(element).addClass(" btn-danger");
					$(element).html("Deactivate");
				} else {

					$(element).attr("is_active", "0");
					$(element).addClass(" btn-success");
					$(element).html("Activate");
				}
			}
		});

	});
	// change is_featured column of a vendor
	$(".vendor-feature-btn").click(function(event) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': "{{csrf_token()}}"
			}
		});
		var element = this;
		$.ajax({
			type: 'POST',
			url: "{{route('admin.vendors.toggle-feature')}}",
			data: {
				id: parseInt($(this).attr("vendor_id"))
			},
			success: function(data) {
				console.log(data);
				$(element).removeClass("btn-danger");
				$(element).removeClass("btn-success");
				if (data['new_is_featured']) {
					$(element).attr("is_featured", "1");
					$(element).addClass(" btn-danger");
					$(element).html("Stop Featuring");
				} else {

					$(element).attr("is_featured", "0");
					$(element).addClass(" btn-success");
					$(element).html("Start Featuring");
				}
			}
		});

	});
</script>
@endsection