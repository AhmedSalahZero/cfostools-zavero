$(document).on("change", ".is-total-branches", function () {
    const isTotalBranches = $("#is-total-branches-1").is(":checked");
    const parent = $(this).closest(".form-group.row");
    if (isTotalBranches) {
        parent
            .find(".total-branch-div")
            .css("display", "initial")
            .find("input,select")
            .prop("disabled", false);
        parent
            .find(".branches-repeater")
            .css("display", "none")
            .find("input,select")
            .prop("disabled", true);
        parent.find(".is-total-branches").val(1);
    } else {
        parent.find(".is-total-branches").val(0);
        parent
            .find(".branches-repeater")
            .css("display", "initial")
            .find("input,select")
            .prop("disabled", false);
        parent
            .find(".total-branch-div")
            .css("display", "none")
            .find("input,select")
            .prop("disabled", true);
    }
});


$(document).on('change','.property-status-js',function(){
	const value = this.value ;
	if(value == 'yes'){
		$('.seat-count-js').fadeIn(200)
		$('.sales-channel-js option:first-of-type').fadeIn(200)
	}else if(value == 'no'){
		$('.seat-count-js').fadeOut(200)
		$('.sales-channel-js option:first-of-type').fadeOut(200)
		$('.sales-channel-js option:nth-of-type(2)').prop('selected',true)
		$('.sales-channel-js').trigger('change')
	}
})
$('.property-status-js').trigger('change')
