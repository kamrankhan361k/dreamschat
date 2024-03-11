/*
Author       : Dreamguys
Template Name: Dreamschat - Admin
Version      : 1.0
*/

"use strict";
window.onload = function () {
    if (envData.DB_INTERFACE_THEME == 'light'){
        $('body').removeClass('darkmode');  
    } else {
        $('body').addClass('darkmode');
    }

    // Get the URL query string
    var queryString = window.location.search;

    // Create a URLSearchParams object from the query string
    var searchParams = new URLSearchParams(queryString);

    // Get the values of specific parameters
    var selectedLanguage = searchParams.get('language');
    var selectedPage = searchParams.get('page');
    
    var languageDataTable = $('#language-lists').DataTable({
        "bFilter": true,
        "ordering": false,
        "language": {
            search: ' ',
            searchPlaceholder: "Search...",
            paginate: {
                next: ' <i class="fas fa-chevron-right"></i>',
                previous: '<i class="fas fa-chevron-left"></i> '
            }
        },
    });

    /*var userref = firebase.database().ref("data/languageKeywords");
    userref.once("value").then(function (snapshot) {
        snapshot.forEach(function(childSnapshot) {
            childSnapshot.forEach(function(childChildSnapshot) {
                console.log(childChildSnapshot.key);
            });
            $("#languages_"+childSnapshot.key).text(childSnapshot.numChildren());
        });
    });*/
    var userref = firebase.database().ref("data/languageKeywords");
    userref.once("value").then(function (snapshot) {
        snapshot.forEach(function (childSnapshot) {
            var languageKey = childSnapshot.key;
            var count = 0;
            var CompletedKeywordCount = 0;
            var donePercentage = 0;
            childSnapshot.forEach(function (childChildSnapshot) {
                childChildSnapshot.forEach(function (keywordSnapshot) {
                    count++;

                    var keywordValue = keywordSnapshot.val();
                    if (keywordValue) {
                        CompletedKeywordCount++;
                    }
                });
            });
            if(count > 0) {
                var completedPercentage = (CompletedKeywordCount/count)*100;
                donePercentage = Math.floor(completedPercentage);
            }
            $("#total-language-keys-" + languageKey).text(count);
            $("#completed-language-keys-" + languageKey).text(CompletedKeywordCount);
            $("#language-keys-progress-" + languageKey).text(donePercentage);
            /*var progressBar = $(".progress-bar");
            progressBar.css("width", donePercentage);
            progressBar.attr("aria-valuenow", donePercentage);
            progressBar.attr("aria-valuemin", "0");
            progressBar.attr("aria-valuemax", donePercentage);*/
        });
    });


    var langref = firebase.database().ref("data/languages");

    langref.on("child_added", function (snapshot) {
        var languages = snapshot.key || '--';
        var code = snapshot.val().code || '--';
        var status = snapshot.val().status || '--';
        var rtl = 'RTL';
        var defaultLanguage = 'English';
        var total = 0;
        var done = 0;
        var progress = 0;
        var action = '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-editlang" onclick="edit_language(\'' + languages + '\', \'' + code + '\', \'' + status + '\')"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<a href="'+baseUrl+'language-keywords-list?language='+languages+'" class="btn btn-danger btn-sm">Web</a>';
        if (languages !== "English") {
            var row = [
                languages,
                code,
                rtl,
                defaultLanguage,
                '<a href="#" id="total-language-keys-'+languages+'">'+ total +'</a>',
                '<a href="#" id="completed-language-keys-'+languages+'">'+ done +'</a>',
                '<div class="track-statistics mb-0"><div class="progress mb-0"><div class="progress-bar bg-success progress-bar[data-language=' + languages + ']" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div></div><div class="statistic-head "><p id="language-keys-progress-'+languages+'">'+progress+' %</p></div></div>',
                //'<a href="#" id="language-keys-progress-'+languages+'">'+ progress +'</a>%',
                status,
                '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-editlang" onclick="edit_language(\'' + languages + '\', \'' + code + '\', \'' + status + '\')"><i class="fa-regular fa-pen-to-square"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="delete_language(\'' + languages + '\', \'' + code + '\',\'' + status + '\')"><i class="fa-regular fa-trash-can"></i></button>&nbsp;<a href="'+baseUrl+'language-keywords-list?language='+languages+'" class="btn btn-danger btn-sm">Web</a>'
            ];
            languageDataTable.row.add(row).draw();
        } else {
            var row = [languages, code, rtl, defaultLanguage, '<a href="#" id="total-language-keys-'+languages+'">'+ total +'</a>', '<a href="#" id="completed-language-keys-'+languages+'">'+ done +'</a>', '<div class="track-statistics mb-0"><div class="progress mb-0"><div class="progress-bar bg-success progress-bar[data-language=' + languages + ']" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div></div><div class="statistic-head "><p id="language-keys-progress-'+languages+'">'+progress+'</p>%</div></div>', status, action];
            languageDataTable.clear().row.add(row).draw();
            //languageDataTable.row.add(row).draw();
        }
    });
}

$(document).on("change", ".language-key-value", function() {
    var keys = $(this).attr('data-key');
    var page = $(this).attr('data-page');
    var language = $(this).attr('data-language');
    var value = $(this).val();

    var obj = {};
    obj[keys] = value;
    firebase.database().ref('data/languageKeywords/' + language + '/' + page + '/').update(obj);
    toastr.success("Language Keyword Updated Successfully");
});

$("#search-language").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $("#language-lists tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#usererror-messages").show();
    } else {
        $("#usererror-messages").hide();
    }
});

$("#search-languages-keyword").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    var $userTableRows = $("#language-listkeyword tr");
    var found = false;
    
    $userTableRows.each(function () {
        var rowText = $(this).text().toLowerCase();
        var isVisible = rowText.indexOf(value) > -1;
        $(this).toggle(isVisible);
        if (isVisible) {
            found = true;
        }
    });
    
    if (!found) {
        $("#usererror-messages").show();
    } else {
        $("#usererror-messages").hide();
    }
});


// Bind the search function to the input field's keyup event
//document.getElementById("search-language").addEventListener("keyup", searchLanguage);



function edit_language(language, code, status) {
    $("#language").val(language);
    $("#e_code").val(code); 
    // console.log(status);
    if(status==='Active'){
        $("#e_status").prop("checked",true);
    } else {
        $("#e_status").prop("checked",false);
    }
    $("#modal-editlang").modal('show');

}



function updatelanguage() {
    var language = $("#language").val();
    
    var code = $("#e_code").val();
    var status = $("#e_status").prop("checked") ? "Active" : "Inactive"; // Get the status from the checkbox
   
    var pathToUpdate = 'data/languages/' + language;

    var updates = {};


    firebase.database().ref(pathToUpdate).update({
        //"language": language,
        "code": code,
        "status": status
    });
    toastr.success("Language Updated Successfully");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed
}
$('#new_language').keypress(function (e) {
    var regex = new RegExp(/^[a-zA-Z\s]+$/);
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    else {
        e.preventDefault();
        return false;
    }
});

function addLanguage() {
    var languages = $("#languages").val();
    var code = $("#code").val();
    var status = $("#status").prop("checked") ? "Active" : "Inactive"; // Check if the checkbox is checked
    if (languages == '') {
        toastr.warning("Please enter a language!");
        return false;
    }
    if (code == '') {
        toastr.warning("Please enter a code!");
        return false;
    }
    if (status == '') {
        toastr.warning("Please enter a status!");
        return false;
    }

    // Assuming you have configured Firebase elsewhere in your code
    var databaseRef = firebase.database().ref('data/languages/'+ languages);

    var data = {
        code: code,
        status: status
    };

    databaseRef.set(data)
        
            $("#modal-addlang").modal('hide');
            $(".new").val('');
            toastr.success("Language Added Successfully");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
       
}

function delete_language(language, code, status) {
    if (language === "English") {
        // Prevent deletion of the default language
        // swal("Warning!", "Default language 'English' cannot be deleted.", "warning");
        return;
    }

    //searchLanguage();
    swal({
        title: "Delete Confirmation",
        text: "Are you sure you want to delete this language?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            firebase.database().ref("data/languages/" + language).remove();
            toastr.success("Language Deleted Successfully");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });
}

var langkeywordDataTable = $('#language-listkeyword').DataTable({
    "bFilter": true,
    "paging": true,
    "ordering": false,
    "language": {
        search: ' ',
        searchPlaceholder: "Search...",
        paginate: {
            next: ' <i class="fas fa-chevron-right"></i>',
            previous: '<i class="fas fa-chevron-left"></i>'
        }
    },
    initComplete: function (settings, json) {
        $('.dataTables_filter').appendTo('#tableSearch');
        $('.dataTables_filter').appendTo('.search-input');
    },
});

// Get the URL query string
var queryString = window.location.search;

// Create a URLSearchParams object from the query string
var searchParams = new URLSearchParams(queryString);

// Get the values of specific parameters
var selectedLanguage = searchParams.get('language');
var selectedPage = searchParams.get('page');

//console.log(param1Value);
//console.log(param2Value);

var langkeywordref = firebase.database().ref("data/languageKeywords/"+selectedLanguage+"/"+selectedPage);
var language = firebase.database().ref("data/languages");

language.on("child_added", function(snapshot) {
    $('#languages').append($("<option></option>").attr("value", snapshot.key).text(snapshot.key));
});

language.on("child_added", function(snapshot) {
    $('#languageKeywords').append($("<option></option>").attr("value", snapshot.key).text(snapshot.key));
});

langkeywordref.on("child_added", function(snapshot) {

    var language = snapshot.key;
    var selectedlanguages = selectedLanguage; //$("#languages").val();
    var label = snapshot.key.replace(/_/g, ' ');
    var label_value = snapshot.val();
    var admin_id = $('#admin_id').val();

    if (admin_id == 'admin') {
        var rowArray = [
            label,
            '<input type="text" class="form-control language-key-value" name="language-key-value" id="language-key-value" data-page="'+selectedPage+'" data-language="'+selectedLanguage+'" data-key="'+snapshot.key+'" value="'+label_value+'">'
        ];

        langkeywordDataTable.row.add(rowArray).draw();
    }
            
});


/*var keywordsRef = firebase.database().ref("data/languageKeywords");
    keywordsRef.once("value").then(function (snapshot) {
            var languageKey = snapshot.key;
            var count = 0;
            var CompletedKeywordCount = 0;
            var donePercentage = 0;
            childSnapshot.forEach(function (childChildSnapshot) {
                childChildSnapshot.forEach(function (keywordSnapshot) {
                    count++;

                    var keywordValue = keywordSnapshot.val();
                    if (keywordValue) {
                        CompletedKeywordCount++;
                    }
                });
            });
            if(count > 0) {
                var completedPercentage = (CompletedKeywordCount/count)*100;
                donePercentage = Math.floor(completedPercentage);
            }
            $("#total-language-keys-" + languageKey).text(count);
            $("#completed-language-keys-" + languageKey).text(CompletedKeywordCount);
            $("#language-keys-progress-" + languageKey).text(donePercentage);
            var progressBar = $(".progress-bar[data-language='" + languageKey + "']");
            progressBar.css("width", donePercentage);
            progressBar.attr("aria-valuenow", donePercentage);
            progressBar.attr("aria-valuemin", "0");
            progressBar.attr("aria-valuemax", donePercentage);
    });*/

var languageKeywordsListTable = $('#language-keywords-list').DataTable({
    "bFilter": true,
    "paging": true,
    "ordering": false,
    "language": {
        search: ' ',
        searchPlaceholder: "Search...",
        paginate: {
            next: ' <i class="fas fa-chevron-right"></i>',
            previous: '<i class="fas fa-chevron-left"></i>'
        }
    },
    initComplete: function (settings, json) {
        $('.dataTables_filter').appendTo('#tableSearch');
        $('.dataTables_filter').appendTo('.search-input');
    },
});


var langKeywordsList = firebase.database().ref("data/languageKeywords");
var languages = firebase.database().ref("data/languages");
var getLanguage = "";
languages.on("child_added", function(snapshot) {
    if(selectedLanguage != "") {
        getLanguage = selectedLanguage;
    } else {
        getLanguage = snapshot.key;
    }
    $('#default_languages').append($("<option></option>").attr("value", snapshot.key).text(snapshot.key));
    //$('#languageKeywords').append($("<option></option>").attr("value", snapshot.key).text(getLanguage));
});

languages.on("child_added", function(snapshot) {
    $('#languageKeywords').append($("<option></option>").attr("value", snapshot.key).text(snapshot.key));
});

langKeywordsList.on("child_added", function(snapshot) {
    var language = snapshot.key;
    var selectedlanguage = $("#default_languages").val();
    if (selectedlanguage == language) {
        snapshot.forEach(function(childSnapshot) {
            childSnapshot.forEach(function(grandChild) {
                var label = grandChild.key || '--';
                var label_value = grandChild.val() || '--';
                var admin_id = $('#admin_id').val() || '--';
                var page = childSnapshot.key;
                var modules = childSnapshot.key;
                var total = 0;
                var completed = 0;
                var progress = 0;
                if (admin_id == 'admin') {
                    var rowArray = [
                        language,
                        page, // You need to define 'page' or replace it with appropriate data
                        modules,
                        total,
                        completed,
                        progress,
                        '<a href="'+baseUrl+'language-keyword?language='+language+'&page='+page+'" class="btn btn-info btn-sm">Edit</a>'
                    ];

                    languageKeywordsListTable.row.add(rowArray).draw();
                }
            });
        });
    }
});

function searchlanguage() {
    var selectedlanguage = $("#languages").val();
    var table = $('#language-listkeyword').DataTable();
    table.clear().draw();

    if (selectedlanguage) {
        firebase.database().ref("data/languageKeywords/" + selectedlanguage).on("child_added", function (snapshot) {
            snapshot.forEach(function (childSnapshot) {
                var page = childSnapshot.key;
                var childData = childSnapshot.val();

                var row = [
                    //selectedlanguage,
                    //snapshot.key,
                    page,
                    childData,
                    //'<button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editlanguage" onclick="edits_language(\'' + selectedlanguage + '\', \'' + snapshot.key + '\', \'' + page + '\', \'' + childData + '\')">Edit</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="deletes_language(\'' + selectedlanguage + '\', \'' + snapshot.key + '\', \'' + page + '\', \'' + childData + '\')">Delete Key</button>'
                ];

                table.row.add(row).draw();
            });
        });
    }
}

function changeLanguage() {
    var selectedlanguage = $("#default_languages").val();
    var table = $('#language-keywords-list').DataTable();

    if (selectedlanguage) {
        table.clear().draw();

        table.destroy();
        table = $('#language-keywords-list').DataTable({
            "bFilter": true,
            "paging": true,
            "ordering": false,
            "language": {
                search: ' ',
                searchPlaceholder: "Search...",
                paginate: {
                    next: ' <i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            },
            initComplete: function (settings, json) {
                $('.dataTables_filter').appendTo('#tableSearch');
                $('.dataTables_filter').appendTo('.search-input');
            },
        });

        var count = 0;
        var CompletedKeywordCount = 0;
        var donePercentage = 0;
        firebase.database().ref("data/languageKeywords/" + selectedlanguage).on("child_added", function (snapshot) {
            //snapshot.forEach(function (childSnapshot) {
                var page = snapshot.key;
                var total = 0;
                var completed = 0;
                var progress = 0;
                var row = [
                    selectedlanguage,
                    page,
                    '<a href="#" id="total-language-keywords-'+snapshot.key+'">'+ total +'</a>',
                    '<a href="#" id="completed-language-keywords-'+snapshot.key+'">'+ completed +'</a>',
                    '<div class="track-statistics mb-0"><div class="progress mb-0"><div class="progress-bar bg-success progress-bar-'+snapshot.key+'" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div></div><div class="statistic-head "><p id="language-keywords-progress-'+snapshot.key+'">'+progress+' %</p></div></div>',
                    '<a href="'+baseUrl+'language-keyword?language='+selectedlanguage+'&page='+page+'" class="btn btn-info btn-sm">Edit</a>'
                   // '<button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editlanguage" onclick="edits_language(\'' + selectedlanguage + '\', \'' + snapshot.key + '\', \'' + page + '\')">Edit</button>'
                ];

                table.row.add(row).draw();
            //});
            
            snapshot.forEach(function (childSnapshot) {
                count++;
                var keywordValue = childSnapshot.val();
                if (keywordValue) {
                    CompletedKeywordCount++;
                }
            });
            if(count > 0) {
                var completedPercentage = (CompletedKeywordCount/count)*100;
                donePercentage = Math.floor(completedPercentage);
            }
            $("#total-language-keywords-" + snapshot.key).text(count);
            $("#completed-language-keywords-" + snapshot.key).text(CompletedKeywordCount);
            $("#language-keywords-progress-" + snapshot.key).text(donePercentage+'%');
            var progressBar = $(".progress-bar-" + snapshot.key);
            progressBar.css("width", donePercentage+'%');
            progressBar.attr("aria-valuenow", donePercentage);
            progressBar.attr("aria-valuemin", "0");
            progressBar.attr("aria-valuemax", donePercentage);

            // Reset counts for the next page
            count = 0;
            CompletedKeywordCount = 0;
            donePercentage = 0;
        });
    }
}


function edits_language(language, page, label, value) {
    $("#e_language").val(language);
    $("#page").val(page);
    $("#label").val(label);
    $("#value").val(value);
}
function deletes_language(language, page, label, value) {
    swal({
        title: "Delete Confirmation",
        text: "Are you sure you want to delete this keyword?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var db = firebase.database();                   
            var ref = db.ref(); 
            var survey=db.ref('data/languageKeywords/'+language+'/'+page);    //Eg path is company/employee                
            survey.child(label).remove();
            searchlanguage();
            toastr.success("Language Deleted Successfully");
            setTimeout(function() {
              window.location.reload();
            }, 2000); // Adjust the delay as needed
        }
    });
}
function updatelanguages() {
    var language = $("#e_language").val();
    var page = $("#page").val();
    var label_key = $("#label").val();
    var value = $("#value").val();
    var obj = {};
    obj[label_key] = value;
    firebase.database().ref('data/languageKeywords/' + language + '/' + page + '/').update(obj);
    $("#modal-editlanguage").modal('hide');
    $(".edit").val('');
    toastr.success("Language Updated Successfully");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed
}
 $('#languageKeywords').keypress(function (e) {
        var regex = new RegExp(/^[a-zA-Z\s]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else {
            e.preventDefault();
            return false;
        }
    });


function addLanguagekeyword() {
    var language = $("#languageKeywords").val();
    var page = $("#new_page").val();
    var label_key = $("#new_label").val();
    var value = $("#new_value").val();

    var obj = {};
    obj[label_key] = value;
    // }                                                                                                                 
    
    if (language == '') {
        toastr.warning("Please enter a language!");
        return false;
    }
    if (page  == '') {
        toastr.warning("Please enter a Page!");
        return false;
    }
    if (label_key  == '') {
        toastr.warning("Please enter a Label!");
        return false;
    }
    if (value  == '') {
        toastr.warning("Please enter a Value!");
        return false;
    }
    firebase.database().ref('data/languageKeywords/' + language + '/' + page + '/').update(obj);
    $("#modal-addlang").modal('hide');
    $(".new").val('');
    searchlanguage();
    toastr.success("Added Successfully");
    setTimeout(function() {
      window.location.reload();
    }, 2000); // Adjust the delay as needed
}

