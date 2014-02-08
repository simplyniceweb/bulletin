;(function(){

	if($(".design").length > 0) {
		$(".design").select2();
	}

	var config = {
		baseUrl : window.location.protocol+"//"+window.location.host+'/bulletin',
		counter : 1,
		doc     : $(document)
	}
	
	var questionConf = {
		trigger : 'button.add-question',
		remove  : 'span.remove-question',
		add     : 'input.survey-interface',
		status  : 0,
	}
	
	var questionFunc = {
		addQuestion : function() {
			return this.delegate(questionConf.trigger, 'click', function (e) {
				e.preventDefault();
				config.counter = config.counter+1;
				$('.survey .form-group:last')
				.after('<div class="form-group input-group this-remove-' + config.counter + '">'+
				'<input type="text" name="questions[]" class="form-control" autocomplete="off" placeholder="Answer #' + config.counter + '"> '+
				'<span data-remove="' + config.counter + '" class="input-group-addon remove-question">'+
				'<a href="javascript: void(0);">Remove</a></span>'+
				'</div>');
			});
		},
		
		removeQuestion : function() {
			return this.delegate(questionConf.remove, 'click', function () {
				removal = $(this).data('remove');
				$('div.this-remove-'+removal).remove();
			});
		},
		
		showSurvey : function() {
			return this.delegate(questionConf.add, 'click', function () {
				if(questionConf.status == 0) {
					$('div.survey').show();
					questionConf.status = 1;
					$(this).val(1);
				} else {
					$('div.survey').hide();
					questionConf.status = 0;
					$(this).val(0);
				}
			});
		}
	}
	
	$.extend(config.doc, questionFunc);
	config.doc.removeQuestion();
	config.doc.addQuestion();
	config.doc.showSurvey();

	var editUserConf = {
		select: ".edit-user"
	}
	
	
	var editUserFunc = {
		showUsers: function(){
			return this.delegate(editUserConf.select, 'change', function () {
				var me = $(this), department_id = me.val();
				if(department_id == "") return false;
				jQuery.ajax({
					type: "POST",
					url: config.baseUrl+"/admin/user_list/",
					data: {'department_id': department_id},
					cache: false,
					success: function (response) {
						$("div.users-list").html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			})
		}
	}
	$.extend(config.doc, editUserFunc);
	config.doc.showUsers();

}(jQuery, window, document));
