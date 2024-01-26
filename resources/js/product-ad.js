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
        // dropdownParent: $('#scrollingSelectContainer'),  // Specify the container for the dropdown
    });
        // Infinite Scroll functionality
    // $('#parentCategory').on('select2:scroll', function() {
    // var lastPage = Math.ceil($('#parentCategory').select2('data').length / 5);
    //         $('#parentCategory').select2('trigger', 'query', {
    //             page: lastPage + 1
    //         });
    //     });



    /**
     * Getting first child category in select
     */
    $('#parentCategory').on('change', function (){
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
            // dropdownParent: $('#scrollingSelectContainer'),  // Specify the container for the dropdown
        });

    });


    /**
     * Getting first child category
     */
    $('#subCategory').on('change', function (){
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
            // dropdownParent: $('#scrollingSelectContainer'),  // Specify the container for the dropdown
        });

    });


});
