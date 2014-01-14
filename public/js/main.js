//CART COMMANDS
$("#showCart").on('click',function(){
	if($("#cart").css('top')=="-290px"){
		$("#showCart").html('Close cart.');
		$("#cart").animate({
			top: "0px"
		});
	} else {
		$("#showCart").html('Open cart.');
		$("#cart").animate({
			top: "-290px"
		});
	}
});
function toTitleCase(str) {
	return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
//COLOR INPUT

$("footer").on('click', 'select#menu > option', function(){
	$("div#boja").css("background-color",$(this).val());
})
$("div#boja").css("background-color",'blue');

$("#ok").click(function(){
	var color = $("#colorInput").val();
	if ($("option[value="+color+"]").length == 0) {
		$("select#menu").append("<option value='"+color+"'>"+ toTitleCase(color) + "</option>");
	};

});

//RIGHT SIDE BANNER!
var i = 0;
var i2 = 0;


setInterval(function() {
		if($("input#checkbox").is(':checked'))
		{
			i = i + 1;
			i = i % 4;
			$("img#banner").attr("src", banners[i])
		}
}, 2000);

//LEFT SIDE BANNER!
setInterval(function() {
		if($("input#checkbox").is(':checked'))
		{
			i2 = i2 - 1;
			i2 = i2 % 4;
			$("img#banner2").attr("src", banners2[i2*-1])
		}
}, 2000);



$('.delete').click(function(e){
	e.preventDefault();
	var id = $(this).data('id');
	var self = this;
	$.ajax({
		url: "productDelete.php",
		type: "get",
		data: {
			id: id
		},
		success: function(data){
			$(self).parents("tr").remove();
		}
	});
});
//AJAX DELETE BACK END
$('.deletePhoto').click(function(e){
	e.preventDefault();
	var id = $(this).data('id');
	var self = this;
	$.ajax({
		url: "fileDelete.php",
		type: "get",
		data: {
			id: id
		},
		success: function(data){
			if (data){
				$(self).parents("li").remove();
			}
		}
	});
});
//parsley initialization
$(document).ready(function() {
	if($('table').not('.cart').length) {
		// $('#like_table').dataTable();
		// $('#categoryTable').dataTable();
		// $('#product_table_user').dataTable();
	}
	//READ MORE BUTTON
	$("#readMore").click(function(){
		var self = $(this);
		$("#more").slideToggle(function(){
	  	if(self.text() == "Read more"){
	  		self.text("Read less");
	  	} else {
	  		self.text("Read more");
	  	}
	  });
	});
	//COMMENT EDIT-BACKEND-TOGGLE
	$(".editComment").click(function(){
		$(this).parent().siblings(".editForm").slideToggle();
	})
	//COMMENT EDIT-BACKEND-REQUEST
		$('.update_comment').click(function(e){
		var text = $(this).siblings('textarea.comment_area').val();
		var id = $(this).data('id');
		var self = this
		$.ajax({
			url: "../commentUpdate.php",
			type: "POST",
			data: {
				id: id,
				text: text
			},
			success: function(data){
					$(".editForm").slideUp();
					$(self).parents('div.well').children("p").text(text);
			}
		});
	});
	//OPEN AND CLOSE THE "LIKED BY" SECTION ON PRODUCT VIEW
	$('a.open_likes').click(function(e){
		e.preventDefault();
		$(this).siblings('.show_liked_by').slideToggle();
	})
	//remove like on profile page
	$('.delete_like').click(function(e){
		e.preventDefault();
		var userId = $(this).data('userid');
		var commentId = $(this).data('commentid');
		var self = this;
		$.ajax({
			url: "unLike.php",
			type: "POST",
			data: {
				userId: userId,
				commentId: commentId
			},
		success: function(data){
			if (data){
				$(self).parents('tr').remove();
				}
			}
		});
	});
	//delete a category
	$('#categoryTable').on('click','a.delete_category',function(e){
		e.preventDefault(e);
		var categoryId = $(this).data('categoryid');
		var self = this;
		$.ajax({
			url: "deleteCategory.php",
			type: "POST",
			data: {
				categoryId: categoryId
			},
		success: function(data){
			if (data){
				$(self).parents('tr').remove();
				}
			}
		});
	});
	//remove a user rating of an item
	$('.delete_rate').click(function(e){
		e.preventDefault();
		var userId = $(this).data('userid');
		var productId = $(this).data('productid');
		var self = this;
		$.ajax({
			url: "deleteRating.php",
			type: "POST",
			data: {
				userId: userId,
				productId: productId
			},
		success: function(data){
			if (data){
				$(self).parents('tr').remove();
				}
			}
		});
	});

	$('#slideTable').on("click", ".deleteCartEntry",function(e){
		e.preventDefault();
		var pid = $(this).data('pid');
		var self = this;
		$.ajax({
			url: "ajaxCartDelete",
			type: "DELETE",
			data: {
				pid: pid
			},
			success: function(data){
				$(self).parents("tr").remove();
			}
		});
	});

	//ajax cart slide controll, when button is pressed cart is generated and updated.
	 $('#showCart').click(function(e){
			 e.preventDefault();
			 var self = this
			 $.ajax({
			    url: "/ajaxSlideCart",
			    type: "GET",
			    data: {},
			    success: function(data){
					$("#slideTable").html(data);
				}
			});
		});
});