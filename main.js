let j = jQuery.noConflict();
j(function () {

    j("#lForm").submit(function (e) {
        e.preventDefault();
        let fm = j(this);
        let form_data = fm.serialize()
        j.ajax({
            url: "validation.php",
            type: "POST",
            data: form_data + "&action=login",
            beforeSend: function () {
            },
            success: function (response){
                let jsonData = JSON.parse(response);
                if (jsonData.success === true) {
                    j.toast({
                        text: jsonData.message, // Text that is to be shown in the toast
                        heading: 'Note', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#00ff04',  // Background color of the toast loader
                        beforeShow: function () {
                        }, // will be triggered before the toast is shown
                        afterShown: function () {
                        }, // will be triggered after the toat has been shown
                        beforeHide: function () {
                        }, // will be triggered before the toast gets hidden
                        afterHidden: function () {
                        }  // will be triggered after the toast has been hidden
                    });
                } else {
                    j.toast({
                        text: jsonData.message, // Text that is to be shown in the toast
                        heading: 'Note', // Optional heading to be shown on the toast
                        icon: 'error', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '##9EC600',  // Background color of the toast loader
                        beforeShow: function () {
                        }, // will be triggered before the toast is shown
                        afterShown: function () {
                        }, // will be triggered after the toat has been shown
                        beforeHide: function () {
                        }, // will be triggered before the toast gets hidden
                        afterHidden: function () {
                        }  // will be triggered after the toast has been hidden
                    });
                }
            },
            error: function (error) {
                j.toast({
                    text: "something went wrong please check your username and password", // Text that is to be shown in the toast
                    heading: "Note", // Optional heading to be shown on the toast
                    icon: "error", // Type of toast icon
                    showHideTransition: "fade", // fade, slide or plain
                    allowToastClose: true, // Boolean value true or false
                    hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: "bottom-left", // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values

                    textAlign: "left", // Text alignment i.e. left, right or center
                    loader: true, // Whether to show loader or not. True by default
                    loaderBg: "#9EC600", // Background color of the toast loader
                    beforeShow: function () {
                    }, // will be triggered before the toast is shown
                    afterShown: function () {
                    }, // will be triggered after the toat has been shown
                    beforeHide: function () {
                    }, // will be triggered before the toast gets hidden
                    afterHidden: function () {
                    }, // will be triggered after the toast has been hidden
                });
            },
            complete: function () {
            },
        });
    });
});
