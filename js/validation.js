// VALIDATES THE USER AND THE ARTICLE

$("#formArticle").validate({
    rules: {
        title:{
            required: true
        },
        description: {
            required: true
        },
        price:{
            required: true
        }
    }
});


$("#formSignUp").validate({
    rules: {
        first_name:{
            required: true
        },
        last_name:{
            required: true
        }
    }
});