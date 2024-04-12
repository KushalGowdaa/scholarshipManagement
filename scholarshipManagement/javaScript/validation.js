//client side validation of the registration form.

const validation = new JustValidate("#register_form");

validation
    .addField("#userName", [{rule: "required"}])

    .addField("#email", [{rule:"required"},{rule: "email"},
    {   //to check if the email is already taken.
        validator: (value) => () => {
            return fetch('../validate-email.php?email=' + encodeURIComponent(value))//returns a promise object
            .then(function(response){
                return response.json();//the promise is then returned using the response json which also generates a promise.
            })
            .then(function(json){
                return json.available;
            });//this is used to return the promise sent by the response.json promise.
        },
        errorMessage: "email already taken"
    }])

    .addField("#password", [{rule: "required"}, {rule: "password"}])

    .addField("#confirmPassword",
    [{validator: (value, fields) => {
        return value === fields["#password"].elem.value;
    },
    errorMessage: "password must match"}])

    .onSuccess((event) => {
        document.getElementById("register_form").submit();
    });