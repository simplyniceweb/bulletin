;(function(){
	var config = {
		baseUrl : window.location.protocol+"//"+window.location.host+'/bulletin',
		doc     : $(document)
	}
	
	// Tabs
	var tabMainConf = {
		tab : '.bulletin-stage ul.nav-justified li',
		admin : '#department_id'
	}
	
	var tabMainFunc = {
		switchTab : function() {
			return this.delegate(tabMainConf.tab, 'click', function(){
				if($(this).hasClass("active")) return false;
				
				$(tabMainConf.tab).each(function() {
					$(tabMainConf.tab).removeClass("active");
				});
				
				$(this).addClass("active");
				tab_id = $(this).data('tab-id');

				jQuery.ajax({
					type: "POST",
					url: config.baseUrl+"/homepage/switch_tab/",
					data: { 'tab_id' : tab_id },
					cache: false,
					success: function (response) {
						$('ul.bulletin-list').html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		adminTab : function() {
			return this.delegate(tabMainConf.admin, 'change', function(){
				me = $(this),
				tab_id = me.val();
				jQuery.ajax({
					type: "POST",
					url: config.baseUrl+"/homepage/switch_tab/",
					data: { 'tab_id' : tab_id },
					cache: false,
					success: function (response) {
						$('ul.bulletin-list').html(response);
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		}
	}
	
	$.extend(config.doc, tabMainFunc);
	config.doc.switchTab();
	config.doc.adminTab();
	
	// Delete
	var deleteConf = {
		image: '.img-square',
		archive_img: '.glyphicon-remove-circle',
		announcement: '.announcement-delete',
		announcement_id: '.announcement-id',
		img: '.img-'
	}
	
	var deleteFunc = {
		view_img: function() {
			return this.delegate(deleteConf.image, "click", function(){
				var me = $(this), img_src = me.attr("src");
				$(".modal-body > img").attr("src", img_src);
			});
		},
		archive_img: function() {
			return this.delegate(deleteConf.archive_img, "click", function(){
				var me = $(this),
				image_id = me.data("entry-id");
				if(!confirm("Are you sure you want to delete this image?")) return false;
				
				jQuery.ajax({
					type: "POST",
					url: config.baseUrl+"/announcement/image/",
					data: { 'image_id' : image_id },
					cache: false,
					success: function (response) {
						me.hide();
						$(deleteConf.img+image_id).slideToggle();
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		},
		announcement: function() {
			return this.delegate(deleteConf.announcement, "click", function(){
				var announce_id = $(deleteConf.announcement_id).val();
				if(!confirm("Are you sure you want to delete this announcement?")) return false;
				
				jQuery.ajax({
					type: "POST",
					url: config.baseUrl+"/announcement/section/",
					data: { 'announce_id' : announce_id },
					cache: false,
					success: function (response) {
						alert("Announcement deleted..");
						location.href="";
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		}
	}

	$.extend(config.doc, deleteFunc);
	config.doc.view_img();
	config.doc.archive_img();
	config.doc.announcement();
	
	var calendarConf = {
		trigger: 'a.calendar-action',
		wrapper: 'div.calendar-wrapper'
	}
	
	var calendarFunc = {
		action: function() {
			return this.delegate(calendarConf.trigger, "click", function(a){
				
				url = $(this).data("url");
				jQuery.ajax({
					type: "POST",
					url: url,
					cache: false,
					success: function (response) {
						$(calendarConf.wrapper).html(response);
						$('a[href*="http://"]').addClass( "badge" );
					}, error: function () {
						console.log('Something went wrong..');
					}
				});
			});
		}
	}

	$.extend(config.doc, calendarFunc);
	config.doc.action();

}(jQuery, window, document));
