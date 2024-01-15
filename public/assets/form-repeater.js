//== Class definition
var FormRepeater = (function () {
    //== Private functions
    var demo1 = function () {
        $("#m_repeater_1").repeater({
            initEmpty: false,
            defaultValues: {
                "text-input": "foo",
            },
            show: function () {
				$("select.repeater-select").selectpicker("refresh");
                // $('.main-service-item').trigger('change');
                $(this).slideDown();
            },
            isFirstItemUndeletable: true,

            hide: function (deleteElement) {
                //    $(this).addClass('will-be-hidden');
                if ($("#first-loading").length) {
                    $(this).hide(deleteElement, function () {
                        deleteElement();
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            $("select.main-service-item").trigger("change");
                        });
                    }
                }
            },
            isFirstItemUndeletable: true,
        });
    };
    // m_repeater_2
	var appendNewOptionsToAllSelects = function(currentRepeaterItem){
		if($('[data-modal-title]').length){
			let currentSelect = $(currentRepeaterItem).find('select').attr('data-modal-name');
			let modalType = $(currentRepeaterItem).find('select').attr('data-modal-type');
			let selects = {};
			$('select[data-modal-name="'+currentSelect+'"][data-modal-type="'+modalType+'"] option').each(function(index,option){
				selects[$(option).attr('value')] = $(option).html() ;
			});
			
			$('select[data-modal-name="'+currentSelect+'"][data-modal-type="'+modalType+'"]').each(function(index,select){
				var selectedValue =  $(select).val() ;
				var currentOptions = '';
				var currentOptionsValue = [];
				$(select).find('option').each(function(index,option){
					var currentOption = $(option).attr('value');
					var isCurrentSelected = currentOption == selectedValue ? 'selected' : '';
					currentOptions+= '<option value="'+ currentOption +'" '+ isCurrentSelected +' > '+ $(option).html()  +' </option>' 
					currentOptionsValue.push(currentOption);
				});
				for(var allOptionValue in selects ){
					if(!currentOptionsValue.includes(allOptionValue)){
						var isCurrentSelected = false ;
						currentOptions+= '<option value="'+ allOptionValue +'" '+ isCurrentSelected +' > '+ selects[allOptionValue]  +' </option>' 
						currentOptionsValue.push(allOptionValue);
					}
				}
				$(select).empty().append(currentOptions).selectpicker('refresh').trigger('change');
				
			})
		}
	}
    var demo2 = function () {
        $("#m_repeater_2").repeater({
            initEmpty: false,

            defaultValues: {
                "text-input": "foo",
            },
            isFirstItemUndeletable: true,
            show: function () {
                $(".main-service-item").trigger("change");
                $(this).slideDown();
				appendNewOptionsToAllSelects(this);
				
            },

            hide: function (deleteElement) {
                if ($("#first-loading").length) {
                    $(this).slideUp(deleteElement, function () {
                        deleteElement();
                        //   $('select.main-service-item').trigger('change');
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            $("select.main-service-item").trigger("change");
                        });
                    }
                }
            },
        });
    };

    var demo3 = function () {
        $("#m_repeater_3").repeater({
            initEmpty: false,

            defaultValues: {
                "text-input": "foo",
            },
            isFirstItemUndeletable: true,

            show: function () {
                $(this).slideDown();
				appendNewOptionsToAllSelects(this);
				
            },

            hide: function (deleteElement) {
                if ($("#first-loading").length) {
                    $(this).slideUp(deleteElement, function () {
                        deleteElement();
                        //   $('select.main-service-item').trigger('change');
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            $("select.main-service-item").trigger("change");
                        });
                    }
                }
            },
        });
    };

    var demo4 = function () {
        $("#m_repeater_4").repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            defaultValues: {
                "text-input": "foo",
            },

            show: function () {
                $(this).slideDown();
				appendNewOptionsToAllSelects(this);
				
            },

            hide: function (deleteElement) {
                if ($("#first-loading").length) {
                    $(this).slideUp(deleteElement, function () {
                        deleteElement();
                        //   $('select.main-service-item').trigger('change');
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            $("select.main-service-item").trigger("change");
                        });
                    }
                }
            },
        });
    };

    var demo5 = function () {
        $("#m_repeater_5").repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            defaultValues: {
                "text-input": "foo",
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                if ($("#first-loading").length) {
                    $(this).slideUp(deleteElement, function () {
                        deleteElement();
                        //   $('select.main-service-item').trigger('change');
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            $("select.main-service-item").trigger("change");
                        });
                    }
                }
            },
        });
    };

    var demo6 = function () {
        $("#m_repeater_6").repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            defaultValues: {
                "text-input": "foo",
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                if ($("#first-loading").length) {
                    $(this).slideUp(deleteElement, function () {
                        deleteElement();
                        //   $('select.main-service-item').trigger('change');
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            $("select.main-service-item").trigger("change");
                        });
                    }
                }
            },
        });
    };

    var demo7 = function () {
        $("#m_repeater_7").repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,
            defaultValues: {
                "text-input": "foo",
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                if ($("#first-loading").length) {
                    $(this).slideUp(deleteElement, function () {
                        deleteElement();
                        //   $('select.main-service-item').trigger('change');
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            $("select.main-service-item").trigger("change");
                        });
                    }
                }
            },
        });
    };

    var demo8 = function () {
        $("#m_repeater_8").repeater({
            initEmpty: false,
            isFirstItemUndeletable: true,

            defaultValues: {
                "text-input": "foo",
            },

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                if ($("#first-loading").length) {
                    $(this).slideUp(deleteElement, function () {
                        deleteElement();
                        //   $('select.main-service-item').trigger('change');
                    });
                } else {
                    if (
                        confirm("Are you sure you want to delete this element?")
                    ) {
                        $(this).slideUp(deleteElement, function () {
                            deleteElement();
                            //$('select.main-service-item').trigger('change');
                        });
                    }
                }
            },
        });
    };

    return {
        // public functions
        init: function () {
            demo1();
            demo2();
            demo3();
            demo4();
            demo5();
            demo6();
            demo7();
            demo8();
        },
    };
})();

jQuery(document).ready(function () {
    FormRepeater.init();
});
