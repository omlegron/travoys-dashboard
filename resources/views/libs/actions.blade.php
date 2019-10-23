@push('js')
	<script src="{{ asset('libs/assets/swal/sweetalert.min.js') }}"></script>
	<script src="{{ asset('libs/jquery/form/jquery.form.min.js') }}"></script>
@endpush

@push('scripts')
	<script type="text/javascript">
		function saveData(formid, callback) 
		{
			// show loading
			$('#' + formid).find('.loading.dimmer').show();

			// begin submit
			$("#" + formid).ajaxSubmit({
				success: function(resp){
					// console.log('save...')
					swal({
						icon: "success",
						title:'Saved!',
						text:'Data succesfully saved.',
						button: false,
						timer: 1000,
					}).then((result) => { 
						$('#' + formid).find('.loading.dimmer').hide();
						callback()
					})
				},
				error: function(resp){
					$('#' + formid).find('.loading.dimmer').hide();
					// $('#cover').hide();
					var response = resp.responseJSON;

					$.each(response.errors, function(index, val) {
						var fg = $('[name="'+ index +'"]').closest('.form-group');
						fg.addClass('has-error');
						fg.append('<small class="control-label error-label font-bold">'+ val +'</small>')
					});

					var intrv = setInterval(function(){
						$('.form-group .error-label').slideUp(500, function(e) {
							$(this).remove();
							$('.form-group.has-error').removeClass('has-error');
							clearTimeout(intrv);
						});
					}, 3000)
				}
			});
		}

		function savePageData(formid, callback) 
		{
			swal({
				title: "Apa data sudah sesuai?",
				text: "Yakin untuk menyimpan data !",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((result) => {
				// show loading
				$('#' + formid).find('.loading.dimmer').show();

				// begin submit
				$("#" + formid).ajaxSubmit({
					success: function(resp){
						// console.log('save...')
						swal({
							icon: "success",
							title:'Saved!',
							text:'Data succesfully saved.',
							button: false,
							timer: 1000,
						}).then((result) => { 
							$('#' + formid).find('.loading.dimmer').hide();
							window.location = '{!! route($routes.'.index') !!}'
						})
					},
					error: function(resp){
						$('#' + formid).find('.loading.dimmer').hide();
						// $('#cover').hide();
						var response = resp.responseJSON;

						$.each(response.errors, function(index, val) {
							var fg = $('[name="'+ index +'"]').closest('.form-group');
							fg.addClass('has-error');
							fg.append('<small class="control-label error-label font-bold">'+ val +'</small>')
						});

						var intrv = setInterval(function(){
							$('.form-group .error-label').slideUp(500, function(e) {
								$(this).remove();
								$('.form-group.has-error').removeClass('has-error');
								clearTimeout(intrv);
							});
						}, 3000)
					}
				});
			});
		}

		function deleteData(url, callback) 
		{
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover the data!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((result) => {
				if (result) {
					$.ajax({
						url: url,
						type: 'POST',
						data: {
							'_method' : 'DELETE',
							'_token' : '{{ csrf_token() }}'
						}
					})
					.done(function(response) {
						swal({
							icon: 'success',
							title:'Deleted!',
							text:'Data has been succesfully deleted!',
							button: false,
							timer: 1000,
					    }).then((res) => {
					    	callback()
					    })
					})
					.fail(function(response) {
						console.log(response);
						swal('Delete data failed!', {
							icon: 'error',
					    }).then((res) => {
					    	callback()
					    })
					})

				}
			})
		}

		function loadModal(param, callback) 
		{
			var url    = (typeof param['url'] === 'undefined') ? '#' : param['url'];
			var modal  = (typeof param['modal'] === 'undefined') ? 'mediumModal' : param['modal'];
			var formId = (typeof param['formId'] === 'undefined') ? 'formData' : param['formId'];
			var onShow = (typeof callback === 'undefined') ? function(){} : callback;
			var modals = $(modal);

			modals.find('.modal-content').html(`
                <div class="loading dimmer" style="height: 200px; top: calc(50% - 100px)">
                    <div class="loader"></div>
                </div>
			`);

			modals.modal('show');
			
			modals.off('shown.bs.modal');
			modals.on('shown.bs.modal', function(event) {
				modals.find('.modal-content').load(url, callback);
			});
		}

		function postNewTab(url, param)
		{
	        var form = document.createElement("form");
	        form.setAttribute("method", 'POST');
	        form.setAttribute("action", url);
	        form.setAttribute("target", "_blank");

	        $.each(param, function(key, val) {
	            var inputan = document.createElement("input");
	                inputan.setAttribute("type", "hidden");
	                inputan.setAttribute("name", key);
	                inputan.setAttribute("value", val);
	            form.appendChild(inputan);
	        });

	        document.body.appendChild(form);
	        form.submit();

	        document.body.removeChild(form);
	    }

	    function getNewTab(url)
	    {
	        var win = window.open(url, '_blank');
	  		win.focus();
	    }

		function showFormError(key, value)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
				if(res[2])
				{
					key = res[0] + '[' + res[1] + ']' + '[' + res[2] + ']';
					if(res[2] == 0)
					{
						key = res[0] + '['+ res[1] +']' + '\\[\\]';
					}
				}
				if(res[3])
				{
					key = res[0] + '[' + res[1] + ']' + '[' + res[2] + ']' + '[' + res[3] + ']';
					if(res[3] == 0)
					{
						key = res[0] + '['+ res[1] +']' + '\\[\\]';
					}
				}
			}
			var elm = $("#dataForm").find('[name="' + key + '"]').closest('.field');
			$(elm).addClass('error');
			console.log(elm);
			var message = `<div class="ui basic red pointing prompt label transition visible">`+ value +`</div>`;

			var showerror = $("#dataForm").find('[name="' + key + '"]').closest('.field');
			$(showerror).append('<div class="ui basic red pointing prompt label transition visible">' + value + '</div>');
		}

		function clearFormError(key, value)
		{
			if(key.includes("."))
			{
				res = key.split('.');
				key = res[0] + '[' + res[1] + ']';
				if(res[1] == 0)
				{
					key = res[0] + '\\[\\]';
				}
				// console.log(key);
			}
			var elm = $("#dataForm").find('[name="' + key + '"]').closest('.field');
			$(elm).removeClass('error');

			var showerror = $("#dataForm").find('[name="' + key + '"]').closest('.field').find('.ui.basic.red.pointing.prompt.label.transition.visible').remove();
		}

		function showLoadingInput(elemchild)
		{
			var loading = `<div class="ui active mini centered inline loader"></div>`;

			$('#'+elemchild).parent().closest('.field').addClass('disabled');
			$('#'+elemchild).parent().closest('.field').append(loading);
		}

		function  stopLoadingInput(elemchild)
		{
			$('#'+elemchild).parent().closest('.field').removeClass('disabled');
			$('#'+elemchild).parent().closest('.field').find('.inline.loader').remove();
		}
	</script>
@endpush