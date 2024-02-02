$(document).ready(function() {

    // Initialize Select2
    $("#parentCategory").select2({
        placeholder: 'Search...',
        width: '100%',
        allowClear: true,
        ajax: {
            url: '/get-parent-category/',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            processResults: function(data, params) {

                params.page = params.page || 1;
                return {
                    results: $.map(data.items, function(val, i) {
                        return {
                            id: val.id,
                            text: val.category_name
                        }
                    }),
                    pagination: {
                        more: (params.page * 5) < data.total_count
                    }
                };
            },
            cache: true
        },
    });



    /**
     * Getting first child category in select
     */
    $('#parentCategory').on('change', function (){
        $('#subCategory').val(null);
        var mainParentId = document.querySelector('#parentCategory').value;
        $("#subCategory").select2({
            placeholder: 'Search...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: '/get-child-option/' + mainParentId,
                dataType: 'json',
                data: function(params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                processResults: function(data, params) {

                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function(val, i) {
                            return {
                                id: val.id,
                                text: val.category_name
                            }
                        }),
                        pagination: {
                            more: (params.page * 5) < data.total_count
                        }
                    };
                },
                cache: true
            },
        });

    });


    /**
     * Getting first child category
     */
    $('#subCategory').on('change', function (){
        $('#subSubCategory').val(null);
        var firstChildId = document.querySelector('#subCategory').value;
        $("#subSubCategory").select2({
            placeholder: 'Search...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: '/get-child-option/' + firstChildId,
                dataType: 'json',
                data: function(params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                processResults: function(data, params) {

                    params.page = params.page || 1;
                    return {
                        results: $.map(data.items, function(val, i) {
                            return {
                                id: val.id,
                                text: val.category_name
                            }
                        }),
                        pagination: {
                            more: (params.page * 5) < data.total_count
                        }
                    };
                },
                cache: true
            },
        });

    });
});
