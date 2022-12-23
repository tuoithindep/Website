// Constructor 
function validator(options) {

    function getParent(element, selector){
        while (element.parentElement) {
            if(element.parentElement.matches(selector)){
                return element.parentElement;
            }
            element = element.parentElement;
        }
    } 

    var selectorRules = {};

    function validate(inputElement, rule) {

        //Get form-message-element from input-element             
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        // Mess return when click outside element
        var errorMessage; 

        // Get all array rules of form-input
        var rules = selectorRules[rule.selector];

        // Get lan luot array rules of form-input
        for (let i = 0; i < rules.length; i++) {
            switch (inputElement.type) {
                case 'checkbox':
                case 'radio':
                    //value input lan luot chay qua cac rule
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked' )
                    );
                    break;
            
                default:
                    //value input lan luot chay qua cac rule
                    errorMessage = rules[i](inputElement.value);
                    break;
            }
            
            //Neu co errormess thi khong duyet nua
            if(errorMessage)
                break;
        }

        if(errorMessage){
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        }else{
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    //Get form-element you want validation
    var formElement = document.querySelector(options.form);
    
    if(formElement){
        //Loai bo hanh dong submit form
        formElement.onsubmit = function (e) {
            e.preventDefault();
            var isFormValid = true;

            options.rules.forEach(rule => {
                //Get input-element  you want validation
                var inputElement = formElement.querySelector(rule.selector); 
                var isValid = validate(inputElement, rule);

                if(!isValid){
                    isFormValid = false;
                }
            });

            if(isFormValid){
                if(typeof options.onSubmit === 'function'){
                    var enableInputs = formElement.querySelectorAll('[name]:not([disable])');
    
                    var formValues = Array.from(enableInputs).reduce(function (values, input) {
                        switch (input.type) {
                            case 'radio':
                                values[input.name] = 
                                formElement.querySelector('input[name = "' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if(!input.matches(':checked')){
                                    return values;
                                }else{
                                    if(!Array.isArray(values[input.name])){
                                        values[input.name] = [];
                                    }
                                    values[input.name].push(input.value);                                  
                                }
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;                                     
                            default:
                                //cart_products
                                values.cart_products = cart_products();

                                // if input type TEXT
                                values[input.name] = input.value;

                                //if is tag DIV and have attribute
                                var l = options.tag_not_input.name_value.length;
                                if(l>0){
                                    var t1 = options.tag_not_input.name_value;
                                    var t2 = options.tag_not_input.tag_selector;     
                                    var t3 = options.tag_not_input.tag_attribute;
                                    for (let x = 0; x < l; x++) {
                                        values[t1[x]] = document.querySelector(t2[x]).getAttribute(t3[x]);                        
                                    }
                                }
                                break;
                        }
                        return values;
                    }, {});               
                    // options.onSubmit(formValues);
                    
                    //! send cookie
                    
                    document.cookie = "cart_products="+ JSON.stringify(formValues) + "; ; path=http://localhost:8081/BTL_WEB/pages/contents/handle/pay_handle.php" ;
                    formElement.submit();
                }
            }
        };

        //Duyet qua tung rule
        options.rules.forEach(rule => {

            //Get input-element  you want validation
            var inputElements = formElement.querySelectorAll(rule.selector); 

            Array.from(inputElements).forEach(inputElement => {
                //Event listener when click outside element
                inputElement.onblur = function () {  
                    validate(inputElement, rule);
                };

                //Event listener when user entering value to input-form
                inputElement.oninput = function () {  
                    //Get form-message-element from input-element             
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                };
            });

            //Storage rules into 1 object with form array, in array is functions 'test'
            if(Array.isArray(selectorRules[rule.selector])){
                selectorRules[rule.selector].push(rule.test);
            }else{
                selectorRules[rule.selector] = [rule.test];
            }
        });
    }
}

//Define rules
validator.isRequire = function (selector, mess){
    return {
        //get id element want check
        selector: selector,

        //Check field
        test: function (value) {
            
            //When input info => return nothing(undifined)
            //When dont have info => return String
            return value ? undefined : mess || 'Vui lòng nhập đủ thông tin';
        }
    };
};

validator.select = function (selector, mess){
    return {
        //get id element want check
        selector: selector,

        //Check field
        test: function (value) {
            
            //When input info => return nothing(undifined)
            //When dont have info => return String
            return value != 0 ? undefined : mess;
        }
    };
};

validator.isEmail = function (selector, mess){
    return {
        //get id element want check
        selector: selector,

        //Check value
        test: function (value) {
            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            return regex.test(value) ? undefined : mess;
        }
    };
};

validator.minLength = function (selector, min, mess){
    return {
        //get id element want check
        selector: selector,

        //Check value
        test: function (value) {
            return value.length >= min ? undefined : mess || `SĐT phải lớn hơn ${min} số` ;
        }
    };
};

validator.isNumber = function (selector, mess){
    return {
        //get id element want check
        selector: selector,

        //Check value
        test: function (value) {
            return isNaN(value) == false ? undefined : mess;
        }
    };
};

validator.isString = function (selector, mess){
    return {
        //get id element want check
        selector: selector,

        //Check value
        test: function (value) {
            return isNaN(value) == true ? undefined : mess;
        }
    };
};

validator.isConfirmed = function (selector, pass, mess){
    return {
        //get id element want check
        selector: selector,
        
        //Check value
        test: function (value) {
            return  value === pass() ? undefined : mess;
        }
    };
};
