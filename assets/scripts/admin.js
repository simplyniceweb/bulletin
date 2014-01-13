;(function(){

	if($(".design").length > 0) {
		$(".design").select2();
	}

	var config = {
		baseUrl : window.location.protocol+"//"+window.location.host+'/survey',
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

}(jQuery, window, document));