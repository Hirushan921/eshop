function changeView() {
    var signInBox = document.getElementById("signInBox");
    var signUpBox = document.getElementById("signUpBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");
}

function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            if (text == "success") {
                alert("Sign Up Sucsess");
                changeView();
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
            } else {
                document.getElementById("msg").innerHTML = text;
            }

        }
    };
    r.open("POST", "signUpProcess.php", true);
    r.send(f);
}


function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var remember = document.getElementById("remember");

    var f2 = new FormData();
    f2.append("email", email.value);
    f2.append("password", password.value);
    f2.append("remember", remember.checked);


    var r = new XMLHttpRequest();
    
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                email.value = "";
                password.value = "";
                window.location = "home.php";

            } else {
                document.getElementById("msg2").innerHTML = text;
            }

        }
    };
    r.open("POST", "signInProcess.php", true);
    r.send(f2);
}

var bm;

function forogotPassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Verification email sent. Please check your inbox.");

                var m = document.getElementById("forgetPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(text);
            }


        }
    };
    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();
}

function showPassword1() {
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "Show";
    }
}

function showPassword2() {
    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnpb.innerHTML == "Show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "Show";
    }
}

function resetPassword() {
    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var form = new FormData();
    form.append("e", e.value);
    form.append("np", np.value);
    form.append("rnp", rnp.value);
    form.append("vc", vc.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Password reset success.");

                bm.hide();
            } else {
                alert(text);
            }

        }
    };
    r.open("POST", "resetPassword.php", true);
    r.send(form);
}

function goToAddProduct() {
    window.location = "addproduct.php";
}

function changeImage() {
    var image = document.getElementById("imguploader");
    var view = document.getElementById("prev");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;
    }
}






function addProduct() {
    var category = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");
    var condition;

    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;
    }

    var color;

    if (document.getElementById("clr1").checked) {
        color = 1;
    } else if (document.getElementById("clr2").checked) {
        color = 2;
    } else if (document.getElementById("clr3").checked) {
        color = 3;
    } else if (document.getElementById("clr4").checked) {
        color = 4;
    } else if (document.getElementById("clr5").checked) {
        color = 5;
    } else if (document.getElementById("clr6").checked) {
        color = 6;
    }

    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delevery_within_colombo = document.getElementById("dwc");
    var delevery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploader");
    // alert(category.value);
    // alert(brand.value);
    // alert(model.value);
    // alert(title.value);
    // alert(condition);
    // alert(color);
    // alert(qty.value);
    // alert(price.value);
    // alert(delevery_within_colombo.value);
    // alert(delevery_outof_colombo.value);
    // alert(description.value);
    // alert(image.value);

    var form = new FormData();
    form.append("c", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("co", condition);
    form.append("col", color);
    form.append("qty", qty.value);
    form.append("p", price.value);
    form.append("dwc", delevery_within_colombo.value);
    form.append("doc", delevery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("img", image.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    };
    r.open("POST", "addProductProcess.php", true);
    r.send(form);


}

function signout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText

            if (t == "success") {
                window.location = "home.php";
            }
        }
    }

    r.open("GET", "signout.php", true);
    r.send();

}

function changeProductView() {
    var add = document.getElementById("addproductbox");
    var update = document.getElementById("updateproductbox");

    add.classList.toggle("d-none");
    update.classList.toggle("d-none");
}

function changeUserImage() {
    var uimage = document.getElementById("profileimg");
    var uview = document.getElementById("view");

    uimage.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        uview.src = url;
    }
}



function updateProfile() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var img = document.getElementById("profileimg");

    var f = new FormData();
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("m", mobile.value);
    f.append("a1", line1.value);
    f.append("a2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);
    f.append("img", img.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };
    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);
}



function changeStatus(id) {
    var productid = id;
    var statuslabel = document.getElementById("checklabel" + productid);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "deactive") {
                statuslabel.innerHTML = "Activate Product";
            } else if (t == "active") {
                statuslabel.innerHTML = "Deactivate Product";
            }
        }
    };
    r.open("GET", "statusChangeProcess.php?p=" + productid, true);
    r.send();
}



function deleteModal(id) {
    var dm = document.getElementById("deleteModal" + id);
    k = new bootstrap.Modal(dm);
    k.show();
}


function deleteproduct(id) {
    var productid = id;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var t = request.responseText;
            if (t == "Product Deleted") {
                alert(t);
                k.hide();
                window.location = "sellerproductview.php";
            } else {
                alert(t);
            }
        }
    };
    request.open("GET", "deleteProductProcess.php?id=" + productid, true);
    request.send();
}


function addFilters(x) {
    var page = x;
    var search = document.getElementById("s");
    var filter = document.getElementById("filterdiv");



    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    var qty;
    if (document.getElementById("h").checked) {
        qty = 1;
    } else if (document.getElementById("l").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }

    var f = new FormData();
    f.append("page", page);
    f.append("s", search.value);
    f.append("a", age);
    f.append("q", qty);
    f.append("c", condition);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            filter.innerHTML = "";
            filter.innerHTML = t;


        }
    };
    r.open("POST", "filterProcess.php", true);
    r.send(f);
}

function clearFilters() {
    window.location = "sellerproductview.php";
}



// function searchtoupdate() {
//     var id = document.getElementById("searchToUpdate").value;
//     var title = document.getElementById("ti");

//     var r = new XMLHttpRequest();
//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             var t = r.responseText;
//             // alert(t);
//             var object = JSON.parse(t);
//             title.value = object["title"];
//         }
//     };

//     r.open("GET", "searchToUpdateProcess.php?id=" + id, true);
//     r.send();
// }



function sendid(id) {
    var id = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "updateProduct.php";
            }
        }
    };

    r.open("GET", "sendIdUpdateProcess.php?id=" + id, true);
    r.send();
}


function updateProduct() {

    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var delevery_within_colombo = document.getElementById("dwc");
    var delevery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imguploader");

    // alert(title.value);
    // alert(qty.value);
    // alert(delevery_within_colombo.value);
    // alert(delevery_outof_colombo.value);
    // alert(description.value);
    // alert(image.value);

    var form = new FormData();
    form.append("t", title.value);
    form.append("qty", qty.value);
    form.append("dwc", delevery_within_colombo.value);
    form.append("doc", delevery_outof_colombo.value);
    form.append("desc", description.value);
    form.append("img", image.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    };
    r.open("POST", "updateProductProcess.php", true);
    r.send(form);

}



function loadmainimg(id) {
    var pid = id;

    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";
}


function qty_inc(qty) {
    var pqty = qty
    var input = document.getElementById("qtyinput");

    if (input.value < pqty) {
        var newvalue = parseInt(input.value) + 1;
        input.value = newvalue.toString();
    } else {
        alert("Maximum quantity count has been achieved");
    }
}

function qty_dec() {
    var input = document.getElementById("qtyinput");

    if (input.value > 1) {
        var newvalue = parseInt(input.value) - 1;
        input.value = newvalue.toString();
    } else {
        alert("Minimum quantity count has been achieved");
    }
}



function basicSearch(x) {
    var page = x;
    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;
    var imgslide = document.getElementById("imgslide");
    var sdetails = document.getElementById("sdetails");

    // alert(searchText);
    // alert(searchSelect);

    var form = new FormData();
    form.append("st", searchText);
    form.append("ss", searchSelect);
    form.append("page", page);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            imgslide.innerHTML = "";
            sdetails.innerHTML = text;

        }
    };
    // r.open("GET", "basicSearchProcess.php?t=" + searchText + "&s=" + searchSelect, true);
    r.open("POST", "basicSearchProcess.php", true);
    r.send(form);
}

function gotoback() {
    window.location = "home.php";
}



function addToWatchlist(id) {
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "watchlist.php";
            } else {
                alert(t);
            }
        }
    };
    r.open("GET", "addToWatchlistProcess.php?id=" + pid, true);
    r.send();
}



function deletefromwatchlist(id) {
    var wid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "watchlist.php";
            }
        }
    };
    r.open("GET", "removeWatchlistItem.php?id=" + wid, true);
    r.send();
}

function goToCart() {
    window.location = "cart.php";
}


function addToCart(id) {
    var qtytxt = document.getElementById("qtytxt" + id).value;
    var pid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "cart.php";
            } else {
                alert(t);
            }
        }
    };
    r.open("GET", "addToCartProcess.php?id=" + pid + "&txt=" + qtytxt, true);
    r.send();
}

function deletefromcart(id) {
    var cid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "cart.php";
            }
        }
    };
    r.open("GET", "deleteFromCartProcess.php?id=" + cid, true);
    r.send();
}

function paynow(id) {

    var id = id;
    var qty = document.getElementById("qtyinput").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(text);
            var obj = JSON.parse(t);
            var mail = obj["email"];
            var amount = obj["amount"];


            if (t == "1") {
                alert("Please Sign In first");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please Update your profile first");
                window.location = "userprofile.php";
            } else {
                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, id, mail, amount, qty);
                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218897", // Replace your Merchant ID
                    "return_url": "http://localhost//eshop/singleProductView.php?id=" + id, // Important
                    "cancel_url": "http://localhost//eshop/singleProductView.php?id=" + id, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"] + ".00",
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["email"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };
                payhere.startPayment(payment);
                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function(e) {
                //     payhere.startPayment(payment);
                // };
            }
        }
    };
    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    r.send();

}


function saveInvoice(orderId, id, mail, amount, qty) {

    var orderid = orderId;
    var pid = id;
    var email = mail;
    var total = amount;
    var pqty = qty;

    var f = new FormData();
    f.append("oid", orderid);
    f.append("pid", pid);
    f.append("email", email);
    f.append("total", total);
    f.append("pqty", pqty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            // if (t == "success") {
            window.location = "invoice.php?id=" + orderId;
            // } else {
            //     alert(t);
            // }
        }
    };
    r.open("POST", "saveInvoice.php", true);
    r.send(f);
}

function printinvoice() {
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("printpage").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function addFeedback(id) {
    var feedmodal = document.getElementById("feedbackModal" + id);
    k = new bootstrap.Modal(feedmodal);
    k.show();
}

function saveFeedback(id) {
    var pid = id;
    var feedtxt = document.getElementById("feedtxt" + id).value;
    // alert(feedtxt);
    var f = new FormData();
    f.append("i", pid);
    f.append("ft", feedtxt);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("Feedback Saved");
                k.hide();
                window.location = "purchasehistory.php";
            }
            // alert(t);
        }
    };

    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}


function adminverification() {
    var e = document.getElementById("e").value;

    var f = new FormData();
    f.append("e", e);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                var verificationModal = document.getElementById("verificationModal");
                k = new bootstrap.Modal(verificationModal);
                k.show();
            } else {
                alert(t);
            }

        }
    };

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verificationcode = document.getElementById("v").value;


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "verifyProcess.php?v=" + verificationcode, true);
    r.send();
}

function blockuser(email) {
    var mail = email;

    var f = new FormData();
    f.append("e", mail);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "manageusers.php";
            }
        }
    };

    r.open("POST", "userBlockProcess.php", true);
    r.send(f);

}


function searchUser() {
    var text = document.getElementById("searchtxt").value;
    var udiv = document.getElementById("udiv");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "no") {
                alert("Please Input email in search field..");
            } else {
                udiv.innerHTML = "";
                udiv.innerHTML = t;
            }
        }
    };

    r.open("GET", "searchUser.php?s=" + text, true);
    r.send();
}

function blockproduct(id) {
    var id = id;



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            window.location = "manageproducts.php";

        }
    };

    r.open("GET", "statusChangeProcess.php?p=" + id, true);
    r.send();
}

function advancedSearch(x) {
    var page = x;
    var viewResult = document.getElementById("viewResult");
    var keyword = document.getElementById("k").value;
    var category = document.getElementById("c").value;
    var brand = document.getElementById("b").value;
    var model = document.getElementById("m").value;
    var condition = document.getElementById("con").value;
    var color = document.getElementById("clr").value;
    var pricefrom = document.getElementById("pf").value;
    var priceto = document.getElementById("pt").value;
    var sort = document.getElementById("sort").value;

    var f = new FormData();
    f.append("page", page);
    f.append("k", keyword);
    f.append("c", category);
    f.append("b", brand);
    f.append("m", model);
    f.append("con", condition);
    f.append("clr", color);
    f.append("pf", pricefrom);
    f.append("pt", priceto);
    f.append("sort", sort);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            viewResult.innerHTML = t;

        }
    };

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}


function dailysellings() {
    var from = document.getElementById("fromdate").value;
    var to = document.getElementById("todate").value;
    var link = document.getElementById("historylink");

    link.href = "SellingHistory.php?f=" + from + "&t=" + to;

}

function viewmsgmodal(id) {
    var pop1 = document.getElementById("msgmodal" + id);

    k = new bootstrap.Modal(pop1);
    k.show();
}

function addnewmodal() {
    var pop = document.getElementById("addnewmodal");

    k = new bootstrap.Modal(pop);
    k.show();
}

function savecategory() {
    var txt = document.getElementById("categorytext").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                k.hide();
                alert("Category Saved Successfully");
                window.location = "manageproducts.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "addNewCategoryProcess.php?t=" + txt, true);
    r.send();
}


function singleviewmodal(id) {
    var pop = document.getElementById("singleproductview" + id);

    k = new bootstrap.Modal(pop);
    k.show();
}


// sendmessage
function sendmessage(mail) {

    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;

    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                // alert("Message Sent Successfully");
                refresher();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);
}

// refresher
function refresher(email) {

    setInterval(refreshmsgare(email), 1000);
    setInterval(refreshrecentarea, 1000);
}

// refres msg view area

function refreshmsgare(email) {

    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", email);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            chatrow.innerHTML = t;

        }
    }

    r.open("POST", "refreshmsgareaprocess.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
        }
    }

    r.open("POST", "refreshrecentareaprocess.php", true);
    r.send();

}