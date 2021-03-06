		var MyValidator = function() {  
    var handleSubmit = function() {  
        $('.form-horizontal').validate({  
            errorElement : 'span',  
            errorClass : 'help-block',  
            focusInvalid : false,  
            rules : {  
                name : {  
                    required : true ,
                    minlength: 2,
                    maxlength: 30
                },  
                uid : {  
                    required : true ,
                    minlength: 1,
                    maxlength: 30
                },
                email: {
							    required: true,
							    email: true,
							    minlength: 2,
                  maxlength: 30
							  },
                password : {  
                    required : true, 
                    minlength: 6,
                 		maxlength: 20 
                },
                cfpassword : {  
                    required : true , 
                    minlength: 6,
                 		maxlength: 20,
                 		equalTo: "#exampleInputPassword1"
                }, 
                verify :
                {
                	required : true , 
                  minlength: 4,
                 	maxlength: 4,
                }, 
                intro : {  
                    required : true  
                }  
            },  
            messages : {  
                name : {  
                    required : "用户名不能为空 Username is required."  
                },
                uid : {  
                    required : "用户名/邮箱/UID不能为空."  
                },   
                password : {  
                    required : "密码不能为空 Password is required."  
                },
                verify : {  
                    required : "验证码不能为空 Verify is required."  
                }, 
            },  
  
            highlight : function(element) {  
                $(element).closest('.form-group').addClass('has-error');  
            },  
  
            success : function(label) {  
                label.closest('.form-group').removeClass('has-error');  
                label.remove();  
            },  
  
            errorPlacement : function(error, element) {  
                element.parent('div').append(error);  
            },  
  
            submitHandler : function(form) {  
                form.submit();  
            }  
        });  
  
        $('.form-horizontal input').keypress(function(e) {  
            if (e.which == 13) {  
                if ($('.form-horizontal').validate().form()) {  
                    $('.form-horizontal').submit();  
                }  
                return false;  
            }  
        });  
    }  
    return {  
        init : function() {  
            handleSubmit();  
        }  
    };  
  
}();  