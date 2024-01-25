$(document).ready(function(){

$('#subCategoryDiv').hide();
$('#subSubCategoryDiv').hide();

/**
* Level 2 category fetch
*/
async function fetchSubCategory() {
    $('#subCategoryDiv').show();
    $('#subCategory').html('<option selected>Select Sub Category</option>');

    var parentId = $('#parentCategory').val();
    const url = 'get-child-option/' + parentId;

    try {
        let response = await axios.get(url);

        if (response.status === 200) {
            let categories = response.data.items;
            categories.forEach(category => {
                $('#subCategory').append(`<option value="${category.id}">${category.category_name}</option>`);
            });
        } else {
            console.error('Error fetching data:', response.statusText);
        }
    } catch (error) {
        console.error('Error fetching data:', error.message);
    }   
}
});