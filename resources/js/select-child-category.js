/**
 * Level 2 Category
 */

async function fetchSubCategory(){
    document.querySelector('#subCategory').innerHTML = '<option selected>Select Sub Category</option>';
    // document.querySelector('#subCategory').innerHTML = '';

    var parentID = document.querySelector('#parentCategory').value;
    const URL = 'get-child-option/'+parentID;
    let response = await axios.get(URL);
    if(response.status===200){
      paginatedData = response.data;
      console.log(paginatedData);
      paginatedData.data.forEach(function (category) {
        $('#subCategory').append('<option value="' + category.id + '">' + category.category_name + '</option>');
      });
    }
    // request.open("GET", "get-child-option/"+parentID, true);
    // request.send();
    // request.onreadystatechange = function(){
    //   if(request.readyState == 4 && request.status == 200){
    //     var data = JSON.parse(request.responseText);
    //     console.log(data);
    //     console.log(data[1]['data'][0]['category_name'])
    //     data.forEach(function (category) {
    //       $('#subCategory').append('<option value="' + category.id + '">' + category.category_name + '</option>');
    //     });
    //   }
    // }
  }


/**
 * Level 3 Category
 */

  async function fetchSubSubCategory(){
    document.querySelector('#subSubCategory').innerHTML = '<option selected>Select Sub Sub Category</option>';
    // document.querySelector('#subCategory').innerHTML = '';

    var parentID = document.querySelector('#subCategory').value;
    const URL = 'get-child-option/'+parentID;
    let response = await axios.get(URL);
    if(response.status===200){
      paginatedData = response.data;
      console.log(paginatedData);
      paginatedData.data.forEach(function (category) {
        $('#subSubCategory').append('<option value="' + category.id + '">' + category.category_name + '</option>');
      });
    }
  }
