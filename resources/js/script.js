let appUrl;
let currentRouteName;
let winnersGemValue;
let mapIsInitialized = false;

let allOnload = async function() {
    appUrl = $("input[name='app_url']").val();
    currentRouteName = $("input[name='route_name']").val();
    winnersGemValue = parseFloat($("input[name='winners_gem_value']").val());

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    setInterval(function() {
        $(".gem-change-color").addClass("text-color-2");
        $(".gem-change-color").removeClass("text-color-1");
        $(".gem-change-color").css("transform", "rotate(0deg)");

        setTimeout(function() {
            $(".gem-change-color").css("transform", "rotate(-15deg)");
            $(".gem-change-color").removeClass("text-color-2");
            $(".gem-change-color").addClass("text-color-1");
        }, 1000);

        setTimeout(function() {
            $(".gem-change-color").css("transform", "rotate(15deg)");
        }, 1500);
    }, 2000);

};

let pageOnload = async function() {
    await allOnload();

    if(currentRouteName === "home.index") {
        homeOnload();
    } else if(currentRouteName === "income.index") {
        incomeOnload();
    } else if(currentRouteName === "orders.index") {
        ordersOnload();
    } else if(currentRouteName === "network.index") {
        networkOnload();
    } else if(currentRouteName === "transfers.index") {
        transfersOnload();
    } else if(currentRouteName === "conversions.index") {
        conversionsOnload();
    } else if(currentRouteName === "withdrawals.index") {
        withdrawalsOnload();
    } else if(currentRouteName === "terminal.index") {
        terminalOnload();
    } else if(currentRouteName === "admin.users.index") {
        adminUsersOnload();
    } else if(currentRouteName === "admin.genealogy.index") {
        adminGenealogyOnload();
    } else if(currentRouteName === "admin.winnersGem.index") {
        adminWinnersGemOnload();
    } else if(currentRouteName === "admin.orders.index") {
        adminOrdersOnload();
    } else if(currentRouteName === "admin.items.index") {
        adminItemsOnload();
    } else if(currentRouteName === "admin.conversions.index") {
        adminConversionsOnload();
    } else if(currentRouteName === "admin.transfers.index") {
        adminTransfersOnload();
    } else if(currentRouteName === "admin.withdrawals.index") {
        adminWithdrawalsOnload();
    }
};
let homeOnload = function() {
    let textWrapper1 = document.querySelector('#text-1');
    textWrapper1.innerHTML = textWrapper1.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc'>$&</span>");

    let textWrapper2 = document.querySelector('#text-2');
    textWrapper2.innerHTML = textWrapper2.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc text-color-1'>$&</span>");

    let textWrapper3 = document.querySelector('#text-3');
    textWrapper3.innerHTML = textWrapper3.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc'>$&</span>");

    let textWrapper4 = document.querySelector('#text-4');
    textWrapper4.innerHTML = textWrapper4.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc text-color-1'>$&</span>");

    let textWrapper5 = document.querySelector('#text-5');
    textWrapper5.innerHTML = textWrapper5.textContent.replace(/\S/g, "<span class='letter code-pro-bold-lc'>$&</span>");

    let textWrapper6 = document.querySelector('#text-6');
    textWrapper6.innerHTML = textWrapper6.textContent.replace(/\S/g, "<span class='letter aileron-regular'>$&</span>");

    anime.timeline({loop: false})
        .add({
            targets: '#text-1 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 150,
            delay: (el, i) => 80 * (i+1)
        }).add({
            targets: '#text-2 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 150,
            delay: (el, i) => 80 * (i+1)
        }).add({
            targets: '#text-3 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 150,
            delay: (el, i) => 80 * (i+1)
        }).add({
            targets: '#text-4 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 150,
            delay: (el, i) => 80 * (i+1)
        }).add({
            targets: '#text-5 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 150,
            delay: (el, i) => 80 * (i+1)
        }).add({
            targets: '#text-6 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 40,
            delay: (el, i) => 10 * (i+1)
        }).add({
            targets: '#text-6 .letter',
            opacity: [1,1],
            easing: "easeInOutQuad",
            duration: 50,
            delay: (el, i) => 30 * (i+1)
        });

    $(".products-carousel").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        centerMode: true,
        centerPadding: '150px',
        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 3,
                    centerPadding: '150px'
                }
            }, {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }, {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '0'
                }
            }
        ]
    });

    AOS.init();
};
let incomeOnload = function() {
    initializeDataTables();
};
let ordersOnload = function() {
    initializeDataTables();
};
let networkOnload = function() {
    getGenealogy(2);
    initializeDataTables();
};
let transfersOnload = function() {
    initializeDataTables();
};
let conversionsOnload = function() {
    initializeDataTables();
};
let withdrawalsOnload = function() {
    initializeDataTables();
};
let terminalOnload = function() {
    $(".data-table").DataTable({
        "aaSorting": [],
        "pageLength": 5
    });

    $("#items-table").DataTable({
        "aaSorting": [],
        "pageLength": 5,
        "order": [[ 2, "desc" ]]
    });

    $(".loading-text").css("display", "none");
    $(".data-table, #items-table").css("display", "table");
};

let adminUsersOnload = function() {
    initializeDataTables();
};
let adminGenealogyOnload = function() {
    getGenealogy(1);
};
let adminWinnersGemOnload = function() {
    initializeDataTables();
};
let adminOrdersOnload = function() {
    initializeDataTables();
};
let adminItemsOnload = function() {
    initializeDataTables();
};
let adminConversionsOnload = function() {
    initializeDataTables();
};
let adminTransfersOnload = function() {
    initializeDataTables();
};
let adminWithdrawalsOnload = function() {
    initializeDataTables();
};

let initMap = function() {
    let map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5.8,
        disableDefaultUI: true,
        center: {
            lat: 14.09782,
            lng: 121.33163
        },
        styles: [
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#e3b504"
                    }
                ]
            }, {
                "featureType": "landscape.natural.terrain",
                "elementType": "geometry",
                "stylers": [
                    {
                        "saturation": -100
                    }
                ]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#e3b504"
                    }
                ]
            }, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#104d22"
                    }
                ]
            }, {
                "featureType": "water",
                "elementType": "labels",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            }
        ]
    });

    let marker = new google.maps.Marker({
        position: {
            lat: 14.09782,
            lng: 121.33163
        },
        map: map,
        icon: {
            url: appUrl + "/img/contact/map-marker.png",
            scaledSize: new google.maps.Size(80, 80)
        }
    });

    if(map) {
        mapIsInitialized = true;
    }
};
let initializeDataTables = function() {
    $(".data-table").DataTable({
        "aaSorting": []
    });
    $(".loading-text").css("display", "none");
    $(".data-table").css("display", "table");
    $(".data-table").removeClass("d-none");
};
let showErrorFromAjax = function(error) {
    let content = "Something went wrong.";

    if(error.responseJSON) {
        content = error.responseJSON.message;

        for (let prop in error.responseJSON.errors) {
            if (Object.prototype.hasOwnProperty.call(error.responseJSON.errors, prop)) {
                content += ' ' + error.responseJSON.errors[prop];
            }
        }
    }

    $("#modal-error .message").html(content);
    $("#modal-error").modal("show");
};
let showRequestError = function(error) {
    let content = "Something went wrong.";

    if(error.response) {
        if(error.response.data) {
            content = error.response.data.message;
            for (let prop in error.response.data.errors) {
                if (Object.prototype.hasOwnProperty.call(error.response.data.errors, prop)) {
                    content += ' ' + error.response.data.errors[prop];
                }
            }
        }
    }

    $("#modal-error .message").html(content);
    $("#modal-error").modal("show");
};
function getOffset(el) {
    const rect = el.getBoundingClientRect();
    return {
        left: rect.left + window.scrollX,
        top: rect.top + window.scrollY
    };
}

$(document).ready(function() {
    pageOnload();
});

$(window).on('scroll', function() {
    let navbar = $(".navbar");

    if($(this).scrollTop() > 0) {
        navbar.addClass("scrolled");
        navbar.removeClass("navbar-dark");
    } else {
        navbar.removeClass("scrolled");
        navbar.addClass("navbar-dark");
    }

    if($("#map").length) {
        if($(this).scrollTop() + $(this).height() >= getOffset($("#footer")[0]).top && !mapIsInitialized) {
            initMap();
        }
    }
});

$(document).on("click", ".navbar-toggler", function() {
    let navbar = $(".navbar");

    if($(this).hasClass("collapsed") && $(window).scrollTop() === 0) {
        navbar.removeClass("scrolled");
        navbar.addClass("navbar-dark");
    } else {
        navbar.addClass("scrolled");
        navbar.removeClass("navbar-dark");
    }
});

// Start:  Registration
$(document).on("submit", "#registration-form", function(e) {
    e.preventDefault();

    let modalWarning = $("#modal-warning");
    modalWarning.find(".message").html("Your registration details will now be processed and recorded.");
    modalWarning.find(".proceed").html("Confirm");
    modalWarning.find(".proceed").attr("id", "register");
    modalWarning.modal("show");
});

$(document).on("click", "#register", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".cancel").addClass("d-none");
    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");

    let form = $("#registration-form");
    let data = new FormData(form[0]);
    let url = form.attr("action");

    axios.post(url, data)
        .then((response) => {
            let modalSuccess = $("#modal-success");

            modalSuccess.attr("data-bs-backdrop", "static");
            modalSuccess.attr("data-bs-keyboard", "false");
            modalSuccess.find("[data-bs-dismiss='modal']").removeAttr("data-bs-dismiss");
            modalSuccess.find(".proceed").attr("onclick", "window.location = '" + response.data.redirect + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");

            modalSuccess.find(".message").html("Great news! Your account creation has been completed successfully.");
            modalSuccess.modal("show");
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.modal("hide");
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find(".cancel").removeClass("d-none");
        });
});
// End: Registration

// Start: Log In
$(document).on("submit", "#login-form", function(e) {
    e.preventDefault();

    let button = $(this).find("[type='submit']");
    button.prop("disabled",true);
    button.html("Logging In...");

    let url = $(this).attr("action");
    let data = new FormData($(this)[0]);

    axios.post(url, data)
        .then((response) => {
            button.html("Redirecting...");
            window.location = response.data.redirect;
        }).catch((error) => {
            button.prop("disabled",false);
            button.html("Log In");

            showRequestError(error);
        });
});
// End: Log In

let genealogy;
let root;
let selected_node;
let generate_referral_table_once = 0;
let account_package = ["", "DBP - ", "DSP - ", "FDP - ", "DMP - ", "FSP - ", "FPP - "];
let ranks = ["Free Account", "Dealer", "Explorer", "Pathfinder", "Navigator", "Master Guide", "Fair Winner", "Grand Fair Winner", "Royal Fair Winner", "Crown Fair Winner"];
let numWords = require('num-words');

let numberToWords = function(number) {
    return numWords(number);
}
let getGenealogy = function(type) {
    $.ajax({
        method: "POST",
        url: $("input[name='get-genealogy-route']").val(),
        data: {
            type: type
        }
    }).done(function(response) {
        genealogy = response.genealogy;
        root = response.root;
        selected_node = response.root;

        generateGenealogy();
    }).fail(function() {
        setTimeout(function() {
            getGenealogy(type);
        },1000);
    });
};
let generateGenealogy = function() {
    var uplines = [];
    uplines.push(selected_node);
    var parsed_upline = selected_node;
    while(parsed_upline > 1 && parsed_upline != root) {
        for(var i = 0; i < genealogy.length; i++) {
            if(genealogy[i].downline == parsed_upline) {
                uplines.push(genealogy[i].upline);
                parsed_upline = genealogy[i].upline;
                break;
            }
        }
    }

    var uplines_breadcrumb = '';
    for(var j = uplines.length - 1; j >= 0; j--) {
        for(var i = 0; i < genealogy.length; i++) {
            if(uplines[j] == genealogy[i].downline) {
                if(j == 0) {
                    uplines_breadcrumb += '<li class="breadcrumb-item active">' + genealogy[i].firstname + " " + genealogy[i].lastname + '</li>';
                } else {
                    uplines_breadcrumb += '<li class="breadcrumb-item">';
                    uplines_breadcrumb += '		<a href="javascript:void(0)" class="uplines link-color-3" node-id="' + genealogy[i].downline + '">' + genealogy[i].firstname + " " + genealogy[i].lastname + '</a>';
                    uplines_breadcrumb += '</li>';
                }
            }
        }
    }
    $(".uplines-container").html(uplines_breadcrumb);

    $("#chart").css("height", ($(window).height() - 100) + "px");

    var chart_config = [];
    var nodes = [];
    var nodes_to_be_parsed = [selected_node];

    chart_config.push({
        container: "#chart",
        nodeAlign: "BOTTOM",
        connectors: {
            type: 'step'
        }
    });

    for(var i = 0; i < genealogy.length; i++) {
        if(genealogy[i].downline == selected_node) {
            nodes[genealogy[i].downline] = {
                HTMLclass: "root",
                text: {
                    name: genealogy[i].firstname + " " + genealogy[i].lastname,
                    id: genealogy[i].downline,
                    rank: account_package[genealogy[i].package_id] + ranks[genealogy[i].rank],
                    username: "Username: " + genealogy[i].username,
                    referral_code: "Referral Code: " + genealogy[i].referral_code
                }
            };
            chart_config.push(nodes[genealogy[i].downline]);
            break;
        }
    }

    var number_of_levels_to_be_shown = $("#number-of-levels-to-be-shown").val();

    for(var j = 0; j < number_of_levels_to_be_shown; j++) {
        var nodes_to_be_parsed_temp = [];

        for(var k = 0; k < nodes_to_be_parsed.length; k++) {
            for(var i = 0; i < genealogy.length; i++) {
                if(genealogy[i].upline == nodes_to_be_parsed[k]) {
                    let content = ' <p class="node-name">' + genealogy[i].firstname + ' ' + genealogy[i].lastname + '</p>';
                    content += '    <p class="node-id">' + genealogy[i].downline + '</p>';
                    content += '    <p class="node-rank">' + account_package[genealogy[i].package_id] + ranks[genealogy[i].rank] + '</p>';
                    content += '    <p class="node-username">Username: ' + genealogy[i].username + '</p>';
                    content += '    <p class="node-referral_code">Referral Code: ' + genealogy[i].referral_code + ' </p>';
                    content += '    <p class="node-button"><button class="btn btn-custom-2 font-size-90 btn-sm node-expand" value="' + genealogy[i].downline + '">Expand</button></p>';

                    nodes[genealogy[i].downline] = {
                        parent: nodes[genealogy[i].upline],
                        innerHTML: content
                    };
                    chart_config.push(nodes[genealogy[i].downline]);
                    nodes_to_be_parsed_temp.push(genealogy[i].downline);
                }
            }
        }

        nodes_to_be_parsed = nodes_to_be_parsed_temp;
    }

    if(generate_referral_table_once == 0) {
        nodes_to_be_parsed = [selected_node];

        var table_content = '<table class="table table-bordered data-table" style="display:none">';
        table_content += '		<thead>';
        table_content += '			<tr>';
        table_content += '				<th>Name</th>';
        table_content += '				<th>Username</th>';
        table_content += '				<th>Referral Code</th>';
        table_content += '				<th>Sponsor Name</th>';
        table_content += '			</tr>';
        table_content += '		</thead>';
        table_content += '		<tbody>';
        while(nodes_to_be_parsed.length > 0) {
            var nodes_to_be_parsed_temp = [];
            for(var k = 0; k < nodes_to_be_parsed.length; k++) {
                for(var i = 0; i < genealogy.length; i++) {
                    if(genealogy[i].upline == nodes_to_be_parsed[k]) {
                        table_content += '	<tr>';
                        table_content += '		<td>' + genealogy[i].firstname + ' ' + genealogy[i].lastname + '</td>';
                        table_content += '		<td>' + genealogy[i].username + '</td>';
                        table_content += '		<td>' + genealogy[i].referral_code + '</td>';
                        table_content += '		<td>' + genealogy[i].upline_firstname + ' ' + genealogy[i].upline_lastname + '</td>';
                        table_content += '	</tr>';
                        nodes_to_be_parsed_temp.push(genealogy[i].downline);
                    }
                }
            }

            nodes_to_be_parsed = nodes_to_be_parsed_temp;
        }
        table_content += '		</tbody>';
        table_content += '	</table>';

        $(".genealogy-table-container").html(table_content);

        $(".data-table").DataTable();
        $(".data-table").css("display","table");

        generate_referral_table_once = 1;
    }

    $("#chart").html('<p class="text-center my-5 py-5">Loading...</p>');

    if($("#has-network").attr("data-value") == 1) {
        setTimeout(function () {
            new Treant(chart_config);

            $('#chart').animate({
                scrollLeft: parseFloat($('.root').css("left")) - ($('#chart').width() / 2) + ($('.node').width() / 2)
            }, 500);
        }, 500);
    } else {
        $("#chart").html('<h5 class="text-center my-5 py-5">No Network</h5>');
    }
};
let load_cart = function(empty_cart) {
    if(empty_cart) {
        remove_from_cart(0);
    }

    var total_quantity = 0;
    var total_price = 0;
    var total_points = 0;
    var content = '	<table class="table table-bordered">';
    $(".cart").each(function() {
        if($(this).attr("data-added-to-cart") == 1) {
            total_quantity += parseInt($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"));
            total_price += $(".product-container[data-id='" + $(this).val() + "']").attr("data-price") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity");
            total_points += $(".product-container[data-id='" + $(this).val() + "']").attr("data-points") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity");

            content += '<tr>';
            content += '	<td style="width:50px">' + $(".product-container[data-id='" + $(this).val() + "']").find(".image-container").html() + '</td>';
            content += '	<td style="text-align:left; position:relative">';
            content += '		<h6 style="font-size:0.9em">' + $(".product-container[data-id='" + $(this).val() + "']").attr("data-name") + '</h6>';
            if($(this).attr("data-type") == 2 || $("input[name='stockist-purchase']:checked").val() > 0) {
                content += '	<p class="mb-0" style="font-size:0.9em">' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-price"),true) + ' Gems &times; ' + $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity") + ' = ' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-price") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"),true) + ' Gems</p>';
                content += '	<p class="mb-0" style="font-size:0.9em">' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-points"),true) + ' PV &times; ' + $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity") + ' = ' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-points") * $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"),true) + ' PV</p>';
                content += '	<div class="btn-group mt-1" role="group">';
                content += '		<button class="btn btn-sm change-quantity" value="' + $(this).val() + '" data-change="-1" style="background-color:#0e4d22; color:#ffffff; width:50px; border-right:1px solid #ffffff"><i class="fas fa-minus"></i></button>';
                content += '		<button class="btn btn-sm change-quantity" value="' + $(this).val() + '" data-change="1" style="background-color:#0e4d22; color:#ffffff; width:50px; border-left:1px solid #ffffff""><i class="fas fa-plus"></i></button>';
                content += '	</div>';
                content += '	<br>';
            }
            content += '		<button class="btn btn-custom-4 btn-sm mt-1 font-size-80 remove-from-cart px-3" value="' + $(this).val() + '">REMOVE FROM CART</button>';
            content += '	</td>';
            content += '</tr>';
        }
    });
    content += '	</table>';
    if(total_quantity == 0) {
        content += '	<tr>';
        content += '		<td>No Items Added Yet</td>';
        content += '	</tr>';
    }
    $("#cart-container").html(content);

    $("#total-quantity").html(numberFormat(total_quantity, false));
    $("#total-price").html(numberFormat(total_price, true));
    $("#total-points").html(numberFormat(total_points, true));
};
let remove_from_cart = function(id) {
    id = parseInt(id);

    if(id === 0) {
        $(".cart").attr("data-added-to-cart", -1);
        $(".cart").removeClass("btn-custom-4");
        $(".cart").addClass("btn-custom-2");
        $(".cart").html('<div class="py-1">ADD TO CART</div>');

        $(".product-container").attr("data-quantity", 1);
    } else {
        $(".cart[value='" + id + "']").attr("data-added-to-cart", -1);
        $(".cart[value='" + id + "']").removeClass("btn-custom-4");
        $(".cart[value='" + id + "']").addClass("btn-custom-2");
        $(".cart[value='" + id + "']").html('<div class="py-1">ADD TO CART</div>');

        $(".product-container[data-id='" + id + "']").attr("data-quantity", 1);
    }
}
let numberFormat = function(x, decimal) {
    x = parseFloat(x);
    var parts = x.toFixed(2).toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(decimal) {
        return parts.join(".");
    } else {
        return parts[0];
    }
};

$(document).on("keypress", ".numeric-only", function(evt) {
    let ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
        evt.preventDefault();
    }
    return true;
});

$(document).on("change", "[name='proof_of_payment[]']", function() {
    let input = $(this)[0];
    let reader = new FileReader();

    reader.onload = function(event) {
        let img = new Image();

        img.onload = function() {
            let height = img.height;
            let width = img.width;

            $("#proof-of-payment-container .proof-of-payment:last").attr("data-image", img.src);
            $("#proof-of-payment-container .proof-of-payment:last").attr("data-has-image", 1);

            let content = ' <div style="position:relative; width:100%; height:100%; padding-top:150px; overflow:hidden">';
            content += '         <img src="' + img.src + '" style="' + ((width >= height) ? 'height:auto; width:100%;' : 'height:100%; width:auto;') + ' margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" />';
            content += '    </div>';

            $("#proof-of-payment-container .proof-of-payment:last").html(content);

            $("#proof-of-payment-container").append($("#proof-of-payment-content").html());
        };

        img.src = event.target.result;
    };

    reader.readAsDataURL(input.files[0]);
});

$(document).on("click", "#change-profile-picture", function() {
    $("[name='profile_picture']").trigger("click");
});

$(document).on("change", "[name='profile_picture']", function() {
    let input = $(this);
    $(".profile-picture-loading").removeClass("d-none");

    let previous_photo = $(".change-profile-picture-container").css("background-image");

    $(".change-profile-picture-container").css("background-image", "none")

    let reader = new FileReader();
    reader.onload = function(event) {
        let img = new Image();

        img.onload = function() {
            $(".change-profile-picture-container").css("background-image", "url('" + img.src + "')");

            let url = $("[name='profile_picture']").attr("data-url");

            let data = new FormData();
            data.append('profile_picture', input[0].files[0]);

            axios.post(url, data)
                .then((response) => {

                }).catch((error) => {
                    $(".change-profile-picture-container").css("background", previous_photo);
                    showRequestError(error);
                }).then(() => {
                    $(".profile-picture-loading").addClass("d-none");
                });
        };

        img.src = event.target.result;
    };

    reader.readAsDataURL(input[0].files[0]);
});

$(document).on("click", ".products-tab", function() {
    load_cart(true);

    $(".products-tab").removeClass("active");
    $(this).addClass("active");

    $(".products-section").addClass("d-none");

    if($(this).data("type") == 1) {
        if($(this).data("package-id") == 0) {
            $(".products-section[data-type='1']").removeClass("d-none");
        } else if($(this).data("package-id") == 4 || $(this).data("package-id") == 5) {
            $(".products-section[data-type='1'][data-package-id='1']").removeClass("d-none");
            $(".products-section[data-type='1'][data-package-id='2']").removeClass("d-none");
            $(".products-section[data-type='1'][data-package-id='3']").removeClass("d-none");
            $(".products-section[data-type='1'][data-package-id='6']").removeClass("d-none");
        } else if($(this).data("package-id") == 2 || $(this).data("package-id") == 6) {
            $(".products-section[data-type='1'][data-package-id='1']").removeClass("d-none");
            $(".products-section[data-type='1'][data-package-id='3']").removeClass("d-none");
        } else if($(this).data("package-id") == 1 || $(this).data("package-id") == 3) {
            $(".products-section[data-type='1'][data-package-id='1']").removeClass("d-none");
            $(".products-section[data-type='1'][data-package-id='3']").removeClass("d-none");
        }
    } else {
        $(".products-section[data-type='" + $(this).data("type") + "']").removeClass("d-none");
    }
});

$(document).on("change", "input[name='stockist-purchase']", function() {
    let stockist = parseInt($("input[name='stockist-purchase']:checked").val());
    let price;

    if(stockist === 0) {
        price = "distributors-price";
        $(".crossed-price").removeClass("d-none");
    } else if(stockist === 1) {
        price = "mobile-price";
        $(".crossed-price").addClass("d-none");
    } else if(stockist === 2) {
        price = "center-price";
        $(".crossed-price").addClass("d-none");
    }

    $("#place-order-form [name='stockist']").val(stockist);

    $(".product-container").each(function() {
        $(this).attr("data-price", $(this).data(price));
        $(this).find(".price").html(numberFormat($(this).attr("data-price"), true));
    });

    let productsTabContainer = $("#products-tab-container");

    if(stockist !== 0) {
        $(".products-section").removeClass("d-none");
        productsTabContainer.addClass("d-none");

        $(".products-tab").removeClass("active");
        $(".products-tab[data-type='2']").addClass("active");
    } else {
        if(parseInt(productsTabContainer.data("hidden")) === 1) {
            productsTabContainer.addClass("d-none");
        } else {
            productsTabContainer.removeClass("d-none");
        }

        $(".products-tab[data-type='2']").trigger("click");
    }

    load_cart(true);
});

$(document).on("click", ".cart", function() {
    $(".cart").prop("disabled", true);
    $(".change-quantity").prop("disabled", true);
    $(".remove-from-cart").prop("disabled", true);

    if($(this).attr("data-type") == 1 && $(".products-tab[data-type='1']").hasClass("active") && parseInt($(this).attr("data-added-to-cart")) === -1) {
        remove_from_cart(0);
    }

    if(parseInt($(this).attr("data-added-to-cart")) === -1) {
        $(this).attr("data-added-to-cart", 1);
        $(this).removeClass("btn-custom-2");
        $(this).addClass("btn-custom-4");
        $(this).html('<div class="py-1">REMOVE FROM CART</div>');
    } else {
        $(this).attr("data-added-to-cart", -1);
        $(this).removeClass("btn-custom-4");
        $(this).addClass("btn-custom-2");
        $(this).html('<div class="py-1">ADD TO CART</div>');
    }

    load_cart(false);

    $(".cart").prop("disabled", false);
    $(".change-quantity").prop("disabled", false);
    $(".remove-from-cart").prop("disabled", false);
});

$(document).on("click", ".change-quantity", function() {
    $(".cart").prop("disabled", true);
    $(".change-quantity").prop("disabled", true);
    $(".remove-from-cart").prop("disabled", true);

    var quantity = parseFloat($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"));
    if($(this).attr("data-change") == 1) {
        quantity++;
    } else {
        quantity--;
        quantity = (quantity == 0) ? 1 : quantity;
    }

    $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity", quantity);

    load_cart(false);

    $(".cart").prop("disabled", false);
    $(".change-quantity").prop("disabled", false);
    $(".remove-from-cart").prop("disabled", false);
});

$(document).on("click", ".remove-from-cart", function() {
    $(".cart").prop("disabled", true);
    $(".change-quantity").prop("disabled", true);
    $(".remove-from-cart").prop("disabled", true);

    remove_from_cart($(this).val());
    load_cart(false);

    $(".cart").prop("disabled", false);
    $(".change-quantity").prop("disabled", false);
    $(".remove-from-cart").prop("disabled", false);
});

$(document).on("submit", "#place-order-form", function(e) {
    e.preventDefault();

    let terminalUser = $(this).find("[name='terminal_user']").val();

    if(terminalUser === '0') {
        $("#modal-warning .message").html("Your order will now be placed.");
    } else {
        let lessInStock = 0;

        $(".cart").each(function() {
            if($(this).attr("data-added-to-cart") == 1) {
                if(parseInt($(".product-container[data-id='" + $(this).val() + "'] .stock").html()) < parseInt($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"))) {
                    lessInStock++;
                }
            }
        });

        let content = '';
        if(lessInStock > 0) {
            content += '<div class="text-center mb-3">';
            content += '	There is insufficient stock for ' + numberToWords(lessInStock) + ' of the items to be ordered, preventing the order from proceeding.';
            content += '</div>';
        } else {
            content += '<div class="text-center mb-3">';
            content += '	This order will now be placed.';
            content += '</div>';
        }

        content += '	<div class="table-responsive">';
        content += '		<table class="table table-bordered font-size-90 mb-0">';
        content += '			<tr style="background-color:#f0f3f5">';
        content += '				<th>Item</th>';
        content += '				<th>In Stock</th>';
        content += '				<th>To Be Ordered</th>';
        content += '			</tr>';
        $(".cart").each(function() {
            if($(this).attr("data-added-to-cart") == 1) {
                content += '	<tr>';
                content += '		<td>' + $(".product-container[data-id='" + $(this).val() + "'] .name").html() + '</td>';
                content += '		<td>' + numberFormat($(".product-container[data-id='" + $(this).val() + "'] .stock").html(),false) + '</td>';
                content += '		<td>' + numberFormat($(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity"),false) + '</td>';
                content += '	</tr>';
            }
        });
        content += '		</table>';
        content += '	</div>';

        $("#modal-warning .message").html(content);
    }

    $("#modal-warning .proceed").attr("id", "place-order");
    $("#modal-warning").modal("show");
});

$(document).on("click", "#place-order", function() {
    let modalWarning = $("#modal-warning");

    let orderedItems = [];
    $(".cart").each(function() {
        if($(this).attr("data-added-to-cart") == 1) {
            orderedItems.push({
                id: $(this).val(),
                quantity: $(".product-container[data-id='" + $(this).val() + "']").attr("data-quantity")
            });
        }
    });

    if(orderedItems.length === 0) {
        modalWarning.modal('hide');

        $("#modal-error .message").html("You haven't added any items to your cart.");
        $("#modal-error").modal("show");

        return 0;
    }

    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");
    modalWarning.find("[data-bs-dismiss='modal']").css("display","none");

    let form = $("#place-order-form");

    let data = new FormData(form[0]);
    data.append('items', JSON.stringify(orderedItems))

    let url = form.attr("action");

    axios.post(url, data)
        .then((response) => {
            let redirect = (parseInt(form.find("[name='terminal_user']").val()) === 0) ? "orders" : "terminal?view=orders";

            let modalSuccess = $('#modal-success');
            modalSuccess.attr("data-bs-backdrop", "static");
            modalSuccess.attr("data-bs-keyboard", "false");
            modalSuccess.find('.proceed').removeAttr("data-bs-dismiss");
            modalSuccess.find('.proceed').attr("onclick", "window.location = '" + redirect + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");
            modalSuccess.find('.message').html("You have successfully submitted your order request.");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.modal('hide');
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find("[data-bs-dismiss='modal']").css("display","block");
        });
});

$(document).on("input", "#purchase-winners-gem-amount", function() {
    $("#purchase-winners-gem-price").val(parseFloat($(this).val() * winnersGemValue).toFixed(2));
});

$(document).on("input", "#purchase-winners-gem-price", function() {
    $("#purchase-winners-gem-amount").val(parseFloat($(this).val() / winnersGemValue).toFixed(2));
});

$(document).on("submit", "#purchase-winners-gem-form", function(e) {
    e.preventDefault();

    $("#modal-warning .message").html("Your Winners Gem purchase request will now be submitted");
    $("#modal-warning .proceed").attr("id", "purchase-winners-gem");
    $("#modal-gem-purchase").modal("hide");
    $("#modal-warning").modal("show");
});

$(document).on("click", "#proof-of-payment-container .proof-of-payment[data-has-image='0']", function() {
    $(this).closest(".col-6").find("input[name='proof_of_payment[]']").trigger("click");
});

$(document).on("click", "#purchase-winners-gem", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");
    modalWarning.find("[data-bs-dismiss='modal']").addClass("d-none");

    let form = $("#purchase-winners-gem-form");

    let data = new FormData(form[0]);
    data.append('winners_gem_value', winnersGemValue);

    let proofOfPaymentInputs = $("input[name='proof_of_payment[]']");
    for (let i = 0; i < proofOfPaymentInputs.length; i++) {
        let files = proofOfPaymentInputs[i].files;
        for (let j = 0; j < files.length; j++) {
            data.append('proof_of_payment[]', files[j]);
        }
    }

    let url = form.attr('action');
    let config = {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    };

    axios.post(url, data, config)
        .then((response) => {
            if(response.data.type && response.data.type === "winners-gem-update") {
                winnersGemValue = parseFloat(response.data.winners_gem_value);
                $("#purchase-winners-gem-amount").val(parseFloat($("#purchase-winners-gem-price").val() / winnersGemValue).toFixed(2));

                $("#modal-error .message").html("Winners Gem value has just changed. Winners Gem to be purchased was updated.");
                $("#modal-error").modal('show');
            } else {
                $("#purchase-winners-gem-amount").val(0)

                let modalSuccess = $('#modal-success');
                modalSuccess.attr("data-bs-backdrop", "static");
                modalSuccess.attr("data-bs-keyboard", "false");
                modalSuccess.find('.proceed').removeAttr("data-bs-dismiss");
                modalSuccess.find('.proceed').attr("onclick", "window.location = '" + response.data.redirect + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");

                modalSuccess.find('.message').html("You have successfully submitted your Winners Gem purchase request.");
                modalSuccess.modal('show');
            }
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find("[data-bs-dismiss='modal']").removeClass("d-none");
            modalWarning.modal("hide");
        });
});

$(document).on("click", ".view-items", function() {
    $("#order-reference").html($(this).attr("data-reference"));
    $("#ordered-items-container").html('<h6 class="text-center">Loading...</h6>');
    $("#modal-view-order-items").modal('show');

    var order_id = $(this).val();

    $.ajax({
        method: "POST",
        url: $("#view-items-route").val(),
        data: {
            order_id: order_id
        }
    }).done(function(response) {
        var content = '	<table class="table table-bordered mb-0">';
        content	+= '		<thead>';
        content	+= '			<tr>';
        content	+= '				<th></th>';
        content	+= '				<th>Item</th>';
        content	+= '				<th>Quantity</th>';
        content	+= '				<th>Amount</th>';
        content	+= '			</tr>';
        content	+= '		</thead>';
        content	+= '		<tbody>';
        for(var i = 0; i < response.items.length; i++) {
            content += '		<tr>';
            content += '			<td style="width:80px">';
            content += '				<div style="position:relative; width:100%; padding-top:100%; overflow:hidden; border:1px solid #eeeeee">';
            content += '					<img src="' + response.items[i].photo + '?v=' + response.items[i].version + '" style="' + ((response.items[i].longestDimension == "width") ? 'width:100%; height:auto;' : 'width:auto; height:100%;') + 'max-height:100%; max-width:100%; margin:0; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" alt="' + response.items[i].name + '">';
            content += '				</div>';
            content += '			</td>';
            content += '			<td>' + response.items[i].name + '</td>';
            content += '			<td>' + response.items[i].quantity + '</td>';
            content += '			<td>' + numberFormat(response.items[i].quantity * response.items[i].price,true) + ' <i class="fas fa-gem gem-change-color" style="font-size:0.8em"></i></td>';
            content += '		</tr>';
        }
        content	+= '		</tbody>';
        content	+= '	</table>';

        $("#ordered-items-container").html(content);
    }).fail(function(error) {
        showErrorFromAjax(error);
    }).always(function() {
        $("#modal-warning").modal('hide');
        $("#modal-warning .proceed").html("Confirm");
        $("#modal-warning .proceed").prop("disabled",false);
        $("#modal-warning [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("change", "#transfer-receiver-username", function() {
    $("#transfer-receiver-blank").css("display", "none");
    $("#transfer-receiver-no-match").css("display", "none");
    $("#transfer-receiver-has-match").css("display", "none");
    $("#transfer-receiver-has-match").html("");
    $("#transfer-receiver-loading").css("display", "inline-block");

    var username = $("#transfer-receiver-username").val();

    var check_receiver = function() {
        $.ajax({
            method: "POST",
            url: $("#check-receiver-route").val(),
            data: {
                username: username
            }
        }).done(function(response) {
            if(response.receiver == "") {
                $("#transfer-receiver-blank").css("display", "none");
                $("#transfer-receiver-no-match").css("display", "inline-block");
                $("#transfer-receiver-has-match").css("display", "none");
                $("#transfer-receiver-has-match").html("");
                $("#transfer-receiver-loading").css("display", "none");
            } else {
                $("#transfer-receiver-has-match").html(response.receiver);

                $("#transfer-receiver-blank").css("display", "none");
                $("#transfer-receiver-no-match").css("display", "none");
                $("#transfer-receiver-has-match").css("display", "inline-block");
                $("#transfer-receiver-loading").css("display", "none");
            }
        }).fail(function() {
            setTimeout(function() {
                check_receiver();
            },1000);
        });
    };

    if(username === "") {
        $("#register-sponsor-blank").css("display", "inline-block");
        $("#register-sponsor-no-match").css("display", "none");
        $("#register-sponsor-has-match").css("display", "none");
        $("#transfer-receiver-has-match").html("");
        $("#register-sponsor-loading").css("display", "none");
    } else {
        check_receiver();
    }
});

$(document).on("click", "#transfer-winners-gem-confirm", function() {
    var receiver = $("#transfer-receiver-has-match").html();
    var amount = numberFormat($("#transfer-winners-gem-amount").val(),true);

    if(receiver != "") {
        $("#modal-warning .message").html("Are you sure you want to transfer " + amount + " <i class='fas fa-gem' style='font-size:0.8em'></i> to " + receiver + "?");
        $("#modal-warning .proceed").attr("id", "transfer-winners-gem");
        $("#modal-transfer").modal("hide");
        $("#modal-warning").modal("show");
    }
});

$(document).on("click", "#transfer-winners-gem", function() {
    $("#modal-warning .proceed").prop("disabled",true);
    $("#modal-warning .proceed").html("Processing...");
    $("#modal-warning [data-bs-dismiss='modal']").css("display","none");

    var username = $("#transfer-receiver-username").val();
    var amount = parseFloat($("#transfer-winners-gem-amount").val());
    var pin_code = $("#transfer-pin-code").val();

    $.ajax({
        method: "POST",
        url: $("#submit-transfer-route").val(),
        data: {
            username: username,
            amount: amount,
            pin_code: pin_code
        }
    }).done(function(response) {
        let receiver = $("#transfer-receiver-has-match").html();

        $("#winners-gem-balance").html(numberFormat(response.gem_balance,true));
        $("#winners-gem-balance-in-pesos").html(numberFormat(response.gem_balance * winnersGemValue,true));
        $("#winners-gem-sent").html(numberFormat(response.gems_sent,true));

        $('#modal-success').attr("data-bs-backdrop", "static");
        $('#modal-success').attr("data-bs-keyboard", "false");
        $('#modal-success .proceed').removeAttr("data-bs-dismiss");
        $('#modal-success .proceed').attr("onclick", "window.location = '/transfers/sent'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");

        $('#modal-success .message').html("You have successfully sent " + numberFormat(amount,true) + " <i class='fas fa-gem' style='font-size:0.8em'></i> to " + receiver + ".");
        $('#modal-success').modal('show');
    }).fail(function(error) {
        showErrorFromAjax(error);
    }).always(function() {
        $("#modal-warning").modal('hide');
        $("#modal-warning .proceed").html("Confirm");
        $("#modal-warning .proceed").prop("disabled",false);
        $("#modal-warning [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("change", "#convert-peso-to-gem-amount", function() {
    $("#convert-total-winners-gem").html(numberFormat($(this).val() / winnersGemValue, true));
});

$(document).on("change", "#convert-gem-to-peso-amount", function() {
    let amount = parseFloat($("#convert-gem-to-peso-amount").val());

    $("#convert-total-peso").html(numberFormat(amount * winnersGemValue,true));
    $("#convert-gem-to-peso-fee-peso").html(numberFormat((amount * winnersGemValue) * 0.02,true));
    $("#convert-gem-to-peso-fee-gem").html(numberFormat(amount * 0.02,true));
    $("#convert-gem-to-peso-total-gems").html(numberFormat(amount * 1.02,true));
});

$(document).on("click", "#convert-confirm", function() {
    var type = $(".convert-tab.active").data("type");
    var amount = parseFloat($("#convert-" + type + "-amount").val());

    if(type == "peso-to-gem") {
        $("#modal-warning .message").html("Are you sure you want to convert <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount,true) + " to Winners Gem?");
    } else {
        $("#modal-warning .message").html("Are you sure you want to convert " + numberFormat(amount,true) + " Winners Gem to Peso?<br>This will cost a total of " + numberFormat(amount * 1.02,true) + " Winners Gem.");
    }

    $("#modal-warning .proceed").attr("id", "convert");

    $("#modal-convert").modal("hide");
    $("#modal-warning").modal("show");
});

$(document).on("click", "#convert", function() {
    $("#modal-warning .proceed").prop("disabled",true);
    $("#modal-warning .proceed").html("Processing...");
    $("#modal-warning [data-bs-dismiss='modal']").css("display","none");

    let type = $(".convert-tab.active").data("type");
    let amount = parseFloat($("#convert-" + type + "-amount").val());

    $.ajax({
        method: "POST",
        url: $("#submit-conversion-route").val(),
        data: {
            type: type,
            amount: amount,
            winners_gem_value: winnersGemValue
        }
    }).done(function(response) {
        if(response.type && response.type === "winners-gem-update") {
            winnersGemValue = parseFloat(response.winners_gem_value);
            $("#purchase-winners-gem-amount").val(parseFloat($(this).val() / winnersGemValue).toFixed(2));

            $("#modal-error .message").html("Winners Gem value has just changed. Winners Gem to be purchased was updated.");
            $("#modal-error").modal('show');
        } else {
            $("#winners-gem-balance").html(numberFormat(response.gemBalance,true));
            $("#winners-gem-balance-in-pesos").html(numberFormat(response.gemBalance * winnersGemValue,true));
            $("#peso-balance").html(numberFormat(response.pesoBalance,true));

            $('#modal-success').attr("data-bs-backdrop", "static");
            $('#modal-success').attr("data-bs-keyboard", "false");
            $('#modal-success .proceed').removeAttr("data-bs-dismiss");
            $('#modal-success .proceed').attr("onclick", "window.location = '" + ((type === "gem-to-peso") ? "/conversions" : "/conversions/peso-to-gem") + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");

            $('#modal-success .message').html("You have successfully converted <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount,true) + " to Winners Gem.");
            $('#modal-success').modal('show');
        }
    }).fail(function() {
        showErrorFromAjax(error);
    }).always(function() {
        $("#modal-warning").modal('hide');
        $("#modal-warning .proceed").html("Confirm");
        $("#modal-warning .proceed").prop("disabled",false);
        $("#modal-warning [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("change", "#withdraw-amount", function() {
    var amount = parseFloat($("#withdraw-amount").val());

    $("#withdraw-transaction-fee").html("<i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount * 0.01,true));
    $("#withdraw-total").html("<i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount * 1.01,true));
});

$(document).on("click", "#withdraw-confirm", function() {
    var amount = parseFloat($("#withdraw-amount").val());

    $("#modal-warning .message").html("Are you sure you want to withdraw <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount,true) + "?<br>Transaction fee costs <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount * 0.01,true) + ".");
    $("#modal-warning .proceed").attr("id", "withdraw");

    $("#modal-withdraw").modal("hide");
    $("#modal-warning").modal("show");
});

$(document).on("click", "#withdraw", function() {
    $("#modal-warning .proceed").prop("disabled",true);
    $("#modal-warning .proceed").html("Processing...");
    $("#modal-warning [data-bs-dismiss='modal']").css("display","none");

    $.ajax({
        method: "POST",
        url: $("#submit-withdrawal-route").val(),
        data: {
            amount: parseFloat($("#withdraw-amount").val())
        }
    }).done(function(response) {
        $('#modal-success').attr("data-bs-backdrop", "static");
        $('#modal-success').attr("data-bs-keyboard", "false");
        $('#modal-success .proceed').removeAttr("data-bs-dismiss");
        $('#modal-success .proceed').attr("onclick", "window.location = 'withdrawals'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");

        $('#modal-success .message').html("Withdrawal request has been successfully submitted");
        $('#modal-success').modal('show');
    }).fail(function(error) {
        showErrorFromAjax(error);
    }).always(function() {
        $("#modal-warning").modal('hide');
        $("#modal-warning .proceed").html("Confirm");
        $("#modal-warning .proceed").prop("disabled",false);
        $("#modal-warning [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("click", "#contribute-to-pool-share-confirm", function() {
    var amount = parseFloat($("#pool-share-contribution-amount").val());

    $("#modal-warning .message").html("Are you sure you want to contribute <i class='fa-solid fa-peso-sign'></i>&nbsp;" + numberFormat(amount,true) + " to Pool Share?");
    $("#modal-warning .proceed").attr("id", "contribute-to-pool-share");

    $("#modal-pool-share-contribute").modal("hide");
    $("#modal-warning").modal("show");
});

$(document).on("click", "#contribute-to-pool-share", function() {
    $("#modal-warning .proceed").prop("disabled",true);
    $("#modal-warning .proceed").html("Processing...");
    $("#modal-warning [data-bs-dismiss='modal']").css("display","none");

    var amount = parseFloat($("#pool-share-contribution-amount").val());

    $.ajax({
        method: "POST",
        url: "api/contribute-to-pool-share.php",
        data: {
            amount: amount
        }
    }).done(function(response) {
        $("#peso-balance").html(numberFormat(response.peso_balance,true));
        $("#pool-share-amount").html(numberFormat(response.pool_share,true));

        $('#modal-success .message').html("You have successfully contributed to pool share. Thank you!");
        $('#modal-success').modal('show');
    }).fail(function(error) {
        showErrorFromAjax(error);
    }).always(function() {
        $("#modal-warning").modal('hide');
        $("#modal-warning .proceed").html("Confirm");
        $("#modal-warning .proceed").prop("disabled",false);
        $("#modal-warning [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("click", ".node-expand", function() {
    selected_node = $(this).val();
    generateGenealogy();
});

$(document).on("click", ".uplines", function() {
    selected_node = $(this).attr("node-id");
    generateGenealogy();
});

$(document).on("change", "#number-of-levels-to-be-shown", function() {
    if($("#number-of-levels-to-be-shown").val() >= 1) {
        generateGenealogy();
    } else {
        $("#modal-error .message").html("Invalid Input");
        $("#modal-error").modal("show");
    }
});

$(document).on("click", "#edit-personal-info-show-fields", function() {
    $("#edit-firstname").prop("disabled", false);
    $("#edit-lastname").prop("disabled", false);
    $("#edit-username").prop("disabled", false);
    $("#edit-email-address").prop("disabled", false);
    $("#edit-contact-number").prop("disabled", false);
    $("#edit-referral-link").prop("disabled", false);
    $("#edit-address").prop("disabled", false);

    $("input[name='payout-method']").prop("disabled",false);
    $(".payout-field input").prop("disabled",false);

    $("#edit-personal-info-show-fields").css("display","none");

    $("#cancel").css("display","inline-block");
    $("#edit-personal-info").css("display","inline-block");
});

$(document).on("keyup", "#edit-referral-link", function(evt) {
    let value = $(this).val();
    let prefix = $(this).attr('data-prefix');

    if (value.substring(0, prefix.length) !== prefix) {
        $(this).val(prefix);
        evt.preventDefault();
    }
    return true;
});

$(document).on("change", "input[name='payout-method']", function() {
    var method = $("input[name='payout-method']:checked").val();

    $(".payout-field").css("display","none");

    if(method == "BDO") {
        $(".payout-method-bdo").css("display","block");
    } else if(method == "Palawan Express") {
        $(".payout-method-palawan-express").css("display","block");
    } else if(method == "GCash") {
        $(".payout-method-gcash").css("display","block");
    } else if(method == "Coins.ph") {
        $(".payout-method-coinsph").css("display","block");
    }
});

$(document).on("click", ".verify-email-show-modal", function() {
    $("#modal-verify-email .proceed").prop("disabled",true);
    $("#modal-verify-email .proceed").html("Sending OTP");
    $("#modal-verify-email [data-bs-dismiss='modal']").css("display","none");

    $("#sending-pin").removeClass("d-none");
    $("#pin-sent").addClass("d-none");
    $("#modal-verify-email").modal("show");

    let url = $(this).val();

    $.ajax({
        method: "POST",
        url: url,
        data: []
    }).done(function(response) {
        $("#sending-pin").addClass("d-none");
        $("#pin-sent").removeClass("d-none");
    }).fail(function(error) {
        $("#modal-verify-email").modal("hide");
        showErrorFromAjax(error);
    }).always(function() {
        $("#modal-verify-email .proceed").prop("disabled",false);
        $("#modal-verify-email .proceed").html("Submit");
        $("#modal-verify-email [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("input", "input[name='otp']", function() {
    $("#verify-email-error").addClass("d-none");
});

$(document).on("submit", "#email-verification-form", function(e) {
    e.preventDefault();

    $("#modal-verify-email .proceed").prop("disabled",true);
    $("#modal-verify-email .proceed").html("Verifying");
    $("#modal-verify-email [data-bs-dismiss='modal']").css("display","none");

    let form = $(this);
    let formData = new FormData(form[0]);

    $.ajax({
        method: "POST",
        url: form.attr('action'),
        cache: false,
        contentType: false,
        processData: false,
        data: formData
    }).done(function(response) {
        $("#modal-verify-email").modal("hide");

        $('#modal-success').attr("data-bs-backdrop", "static");
        $('#modal-success').attr("data-bs-keyboard", "false");
        $("#modal-success [data-bs-dismiss='modal']").removeAttr("data-bs-dismiss");
        $('#modal-success .proceed').attr("onclick", "window.location = '/profile'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Reloading...')");

        $("#modal-success .message").html("You have successfully verified your email address.");
        $("#modal-success").modal("show");
    }).fail(function(error) {
        let content = "Something went wrong.";

        if(error.responseJSON) {
            content = error.responseJSON.message;

            for (let prop in error.responseJSON.errors) {
                if (Object.prototype.hasOwnProperty.call(error.responseJSON.errors, prop)) {
                    content += ' ' + error.responseJSON.errors[prop];
                }
            }
        }

        $("#verify-email-error").html(content);
        $("#verify-email-error").removeClass("d-none");
    }).always(function() {
        $("#modal-verify-email .proceed").prop("disabled",false);
        $("#modal-verify-email .proceed").html("Submit");
        $("#modal-verify-email [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("click", "#reset-password-show-modal", function() {
    if(!$(this).val()) {
        $("#modal-email-not-verified").modal("show");
    } else {
        $("#modal-reset-password").modal("show");

        $.ajax({
            method: "POST",
            url: $("#send-reset-password-link-route").val(),
            data: []
        }).done(function(response) {
            $('#modal-success .message').html('We sent a reset password link to <span class="fw-bold">' + $("#reset-password-link-email").html() + '</span>');
            $("#modal-success").modal("show");
        }).fail(function(error) {
            showErrorFromAjax(error);
        }).always(function() {
            $("#modal-reset-password").modal("hide");
        });
    }
});

$(document).on("submit", "#reset-password-form", function(e) {
    e.preventDefault();

    let form = $(this);

    form.find("button[type='submit']").prop("disabled",true);
    form.find("button[type='submit']").html("Resetting Password");

    let formData = new FormData(form[0]);

    $.ajax({
        method: "POST",
        url: form.attr('action'),
        cache: false,
        contentType: false,
        processData: false,
        data: formData
    }).done(function(response) {
        $('#modal-success').attr("data-bs-backdrop", "static");
        $('#modal-success').attr("data-bs-keyboard", "false");
        $("#modal-success [data-bs-dismiss='modal']").removeAttr("data-bs-dismiss");
        $('#modal-success .proceed').attr("onclick", "window.location = '" + response.redirect + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Reloading...')");

        $("#modal-success .message").html("You have successfully updated your password.");
        $("#modal-success").modal("show");
    }).fail(function(error) {
        showErrorFromAjax(error);
    }).always(function() {
        form.find("button[type='submit']").prop("disabled",false);
        form.find("button[type='submit']").html("Reset Password");
    });
});

$(document).on("click", "#cancel", function() {
    $("#edit-firstname").prop("disabled", true);
    $("#edit-lastname").prop("disabled", true);
    $("#edit-username").prop("disabled", true);
    $("#edit-email-address").prop("disabled", true);
    $("#edit-contact-number").prop("disabled", true);
    $("#edit-referral-link").prop("disabled", true);
    $("#edit-address").prop("disabled", true);

    $("#edit-firstname").val($("#edit-firstname").attr("prev-value"));
    $("#edit-lastname").val($("#edit-lastname").attr("prev-value"));
    $("#edit-username").val($("#edit-username").attr("prev-value"));
    $("#edit-email-address").val($("#edit-email-address").attr("prev-value"));
    $("#edit-contact-number").val($("#edit-contact-number").attr("prev-value"));
    $("#edit-referral-link").val($("#edit-referral-link").attr("prev-value"));
    $("#edit-address").val($("#edit-address").attr("prev-value"));

    $("input[name='payout-method']").prop("disabled",false);
    $(".payout-field input").prop("disabled",true);

    $("#edit-payout-account-number").val($("#edit-payout-account-number").attr("prev-value"));
    $("#edit-payout-account-name").val($("#edit-payout-account-name").attr("prev-value"));
    $("#edit-payout-name").val($("#edit-payout-name").attr("prev-value"));
    $("#edit-payout-mobile-number").val($("#edit-payout-mobile-number").attr("prev-value"));
    $("#edit-payout-wallet-address").val($("#edit-payout-wallet-address").attr("prev-value"));

    $("#edit-personal-info-show-fields").css("display","inline-block");
    $("#change-password-show-fields").css("display","inline-block");

    $("#cancel").css("display","none");
    $("#edit-personal-info").css("display","none");
    $("#change-password").css("display","none");
});

$(document).on("click", "#edit-personal-info", function() {
    $("#edit-personal-info").prop("disabled",true);
    $("#edit-personal-info").html("Saving Changes...");
    $("#cancel").css("display","none");

    var firstname = $("#edit-firstname").val();
    var lastname = $("#edit-lastname").val();
    var username = $("#edit-username").val();
    var email_address = $("#edit-email-address").val();
    var contact_number = $("#edit-contact-number").val();
    var referral_code = $("#edit-referral-link").val();
    var address = $("#edit-address").val();

    var payout_method = $("input[name='payout-method']:checked").val();
    var payout_account_number = $("#edit-payout-account-number").val();
    var payout_account_name = $("#edit-payout-account-name").val();
    var payout_name = $("#edit-payout-name").val();
    var payout_mobile_number = $("#edit-payout-mobile-number").val();
    var payout_wallet_address = $("#edit-payout-wallet-address").val();

    $.ajax({
        method: "POST",
        url: $("#edit-personal-info-route").val(),
        data: {
            firstname: firstname,
            lastname: lastname,
            username: username,
            email_address: email_address,
            contact_number: contact_number,
            referral_code: referral_code,
            address: address,
            payout_method: payout_method,
            payout_account_number: payout_account_number,
            payout_account_name: payout_account_name,
            payout_name: payout_name,
            payout_mobile_number: payout_mobile_number,
            payout_wallet_address: payout_wallet_address
        }
    }).done(function(response) {
        $("#edit-firstname").prop("disabled",true);
        $("#edit-lastname").prop("disabled",true);
        $("#edit-username").prop("disabled",true);
        $("#edit-email-address").prop("disabled",true);
        $("#edit-contact-number").prop("disabled",true);
        $("#edit-referral-link").prop("disabled",true);
        $("#edit-address").prop("disabled",true);

        $("#edit-firstname").prop("disabled",true);
        $("#edit-lastname").prop("disabled",true);
        $("#edit-username").prop("disabled",true);
        $("#edit-email-address").attr("prev-value", email_address);
        $("#edit-contact-number").attr("prev-value", contact_number);
        $("#edit-referral-link").attr("prev-value", referral_code);
        $("#edit-address").attr("prev-value", address);

        $("input[name='payout-method']").prop("disabled",true);
        $(".payout-field input").prop("disabled",true);

        $("#edit-payout-account-number").attr("prev-value", payout_account_number);
        $("#edit-payout-account-name").attr("prev-value", payout_account_name);
        $("#edit-payout-name").attr("prev-value", payout_name);
        $("#edit-payout-mobile-number").attr("prev-value", payout_mobile_number);
        $("#edit-payout-wallet-address").attr("prev-value", payout_wallet_address);

        $("#cancel").css("display","none");
        $("#edit-personal-info").css("display","none");

        $("#edit-personal-info-show-fields").css("display","inline-block");

        $('#modal-success .message').html("Saving Changes Successful");
        $("#modal-success").modal("show");
    }).fail(function(error) {
        $("#cancel").css("display","inline-block");
        showErrorFromAjax(error);
    }).always(function() {
        $("#edit-personal-info").html("Save Changes");
        $("#edit-personal-info").prop("disabled",false);
    });
});

$(document).on("click", ".view-payout-information", function() {
    var payout_information = JSON.parse($(this).find("span").html());

    var content = '	<table class="table table-bordered mb-0">';
    content += '		<tbody>';
    content += '			<tr>';
    content += '				<th style="background-color:#fafafa; text-align:right">Method</th>';
    content += '				<td style="text-align:left">' + payout_information.method + '</td>';
    content += '			</tr>';
    if(payout_information.method == "BDO") {
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Account Number</th>';
        content += '			<td style="text-align:left">' + payout_information.account_number + '</td>';
        content += '		</tr>';
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Account Name</th>';
        content += '			<td style="text-align:left">' + payout_information.account_name + '</td>';
        content += '		</tr>';
    } else if(payout_information.method == "Palawan Express") {
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Name</th>';
        content += '			<td style="text-align:left">' + payout_information.name + '</td>';
        content += '		</tr>';
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Mobile Number</th>';
        content += '			<td style="text-align:left">' + payout_information.mobile_number + '</td>';
        content += '		</tr>';
    } else if(payout_information.method == "GCash") {
        content += '			<tr>';
        content += '				<th style="background-color:#fafafa; text-align:right">Mobile Number</th>';
        content += '				<td style="text-align:left">' + payout_information.mobile_number + '</td>';
        content += '			</tr>';
    } else if(payout_information.method == "Coins.ph") {
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Wallet Address</th>';
        content += '			<td style="text-align:left">' + payout_information.wallet_address + '</td>';
        content += '		</tr>';
    }
    content += '		</tbody>';
    content += '	</table>';

    $("#payout-information-container").html(content);

    $("#modal-payout-information").modal("show");
});

$(document).on("click", ".update-proof-of-payment", function() {
    $("#modal-proof-of-payment-update").modal("show");
    $("#proof-of-payment-container").html('<h6 class="text-center">Loading...</h6>');
    $("#update-proof-of-payment-confirm").val($(this).val());

    var proof_of_payments = JSON.parse($(this).find("span").html());

    var content = '';
    var i = 0;

    var load_image = function() {
        var img = new Image();

        img.onload = function() {
            var height = img.height;
            var width = img.width;

            content += '	<div class="col-6 px-1" style="margin-bottom:10px">';
            content += '		<a href="' + img.src + '" data-fancybox="images" data-caption="Proof of Payment">';
            content += '			<div class="proof-of-payment" data-image="' + img.src + '" data-has-image="1" data-extension="' + img.src.split('.').pop().toLowerCase() + '" style="width:100%; height:154px; background-color:#eeeeee; border:2px solid #0e4d22; position:relative; cursor:pointer">';
            content += '				<div class="background-image-contain" style="position:relative; width:100%; height:100%; padding-top:150px; overflow:hidden; background-image:url(\'' + img.src + '\')"></div>';
            content += '			</div>';
            content += '		</a>';
            content += '	</div>';

            if(i == proof_of_payments.length - 1) {
                content += $("#proof-of-payment-content").html();
                $("#proof-of-payment-container").html(content);
            } else {
                load_image(proof_of_payments[++i]);
            }
        };

        img.src = proof_of_payments[i];
    };

    if(proof_of_payments.length > 0) {
        load_image(proof_of_payments[i]);
    } else {
        $("#proof-of-payment-container").html($("#proof-of-payment-content").html());
    }
});

$(document).on("click", "#update-proof-of-payment-confirm", function() {
    $("#modal-warning .message").html("Are you sure you want to save changes?");
    $("#modal-warning .proceed").attr("id", "update-proof-of-payment");
    $("#modal-warning .proceed").val($(this).val());
    $("#modal-proof-of-payment-update").modal("hide");
    $("#modal-warning").modal("show");
});

$(document).on("click", "#update-proof-of-payment", function() {
    $("#modal-warning .proceed").prop("disabled",true);
    $("#modal-warning .proceed").html("Processing...");
    $("#modal-warning [data-bs-dismiss='modal']").css("display","none");

    var id = $(this).val();

    var proof_of_payments = [];
    $("#proof-of-payment-container .proof-of-payment[data-has-image='1']").each(function() {
        proof_of_payments.push({
            image: $(this).attr("data-image"),
            extension: $(this).attr("data-extension")
        });
    });

    $.ajax({
        method: "POST",
        url: $("#update-proof-of-payment").val(),
        data: {
            id: id,
            proof_of_payments: JSON.stringify(proof_of_payments)
        }
    }).done(function(response) {
        $(".update-proof-of-payment[value='" + id + "'] span").html(response.proof_of_payment);

        $('#modal-success .message').html("Saving changes successful.");
        $('#modal-success').modal('show');
    }).fail(function(error) {
        showErrorFromAjax(error);
    }).always(function() {
        $("#modal-warning").modal('hide');
        $("#modal-warning .proceed").html("Confirm");
        $("#modal-warning .proceed").prop("disabled",false);
        $("#modal-warning [data-bs-dismiss='modal']").css("display","block");
    });
});

$(document).on("click", ".view-shipment", function() {
    $(".order-reference").html($(this).data("reference"));
    $("#shipment-full-name").html(($(this).data("full-name") != "") ? $(this).data("full-name") : '<span style="font-style:italic">Empty</span>');
    $("#shipment-contact-number").html(($(this).data("contact-number") != "") ? $(this).data("contact-number") : '<span style="font-style:italic">Empty</span>');
    $("#shipment-barangay").html(($(this).data("barangay") != "") ? $(this).data("barangay") : '<span style="font-style:italic">Empty</span>');
    $("#shipment-city").html(($(this).data("city") != "") ? $(this).data("city") : '<span style="font-style:italic">Empty</span>');
    $("#shipment-province").html(($(this).data("province") != "") ? $(this).data("province") : '<span style="font-style:italic">Empty</span>');
    $("#shipment-zip-code").html(($(this).data("zip-code") != "") ? $(this).data("zip-code") : '<span style="font-style:italic">Empty</span>');

    $("#modal-view-shipment").modal('show');
});

$(document).on("click", ".mark-order-as-complete-confirm", function() {
    $("#modal-warning .message").html("Are you sure you want to mark Order " + $(this).data("reference") + " as complete?");
    $("#modal-warning .proceed").val($(this).val());
    $("#modal-warning .proceed").attr("data-from", $(this).attr("data-from"));
    $("#modal-warning .proceed").attr("id", "mark-order-as-complete");
    $('#modal-warning').modal('show');
});

$(document).on("click", "#mark-order-as-complete", function() {
    $("#modal-warning .proceed").prop("disabled",true);
    $("#modal-warning .proceed").html("Processing...");
    $("#modal-warning [data-bs-dismiss='modal']").css("display","none");

    let id = $(this).val();
    let from = $(this).attr("data-from");

    $.ajax({
        method: "POST",
        url: $("#mark-order-as-complete-route").val(),
        data: {
            id: id,
            from: from
        }
    }).done(function(response) {
        $("#orders-table-container").html(response.content);
        initializeDataTables();

        if(from === "terminal") {
            $("#terminal-winners-gem").html(response.terminalWinnersGem);
        }

        $('#modal-success .message').html("Order has been successfully completed.");
        $('#modal-success').modal('show');
    }).fail(function(error) {
        showErrorFromAjax(error);
    }).always(function() {
        $('#modal-warning').modal('hide');
        $("#modal-warning [data-bs-dismiss='modal']").css("display","block");
        $("#modal-warning .proceed").html("Confirm");
        $("#modal-warning .proceed").prop("disabled",false);
    });
});

$(document).on("click", "#minimize-side-nav", function() {
    if($(".profile-pic-lg").hasClass("d-none")) {
        $(".profile-pic-lg").removeClass("d-none");
        $(".profile-pic-sm").addClass("d-none");
    } else {
        $(".profile-pic-sm").removeClass("d-none");
        $(".profile-pic-lg").addClass("d-none");
    }
});

// Admin Dashboard
$(document).on("submit", "#update-winners-gem-value-form", function(e) {
    e.preventDefault();

    $("#modal-warning .message").html("Are you sure you want to save changes?");
    $("#modal-warning .proceed").attr("id", "update-winners-gem-value");

    $("#modal-winners-gem-value").modal("hide");
    $("#modal-warning").modal("show");
});

$(document).on("click", "#update-winners-gem-value", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");
    modalWarning.find("[data-bs-dismiss='modal']").css("display","none");

    let form = $("#update-winners-gem-value-form");
    let data = new FormData(form[0]);
    let url = form.attr('action');

    axios.post(url, data)
        .then((response) => {
            $("#winners-gem-current-value").html(numberFormat(response.data.winnersGemValue,true));
            $(".winners-gem-value").html(response.data.winnersGemValue);

            let modalSuccess = $('#modal-success');
            modalSuccess.find(".message").html("Saving changes successful.");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find("[data-bs-dismiss='modal']").css("display","block");
            modalWarning.modal("hide");
        });
});

// Admin Users
$(document).on("click", ".set-stockist-confirm", function() {
    if(($(this).data("stockist") == 1 && $("#assignable-accounts").val() != -1 && $("#assignable-center-stockists").val() != -1) || ($(this).data("stockist") == 2 && $("#assignable-accounts").val() != -1) || ($(this).data("stockist") == 0 && $("#removable-accounts").val() != -1)) {
        let name;

        if($(this).data("stockist") == 0) {
            name = $("#removable-accounts option[value='" + $("#removable-accounts").val() + "']").html();
            $("#modal-warning .message").html("Are you sure you want to remove " + name + " as " + (($("#stockist").html() == 1) ? "Mobile" : "Center") + " Stockist?");
        } else {
            name = $("#assignable-accounts option[value='" + $("#assignable-accounts").val() + "']").html();
            $("#modal-warning .message").html("Are you sure you want to make " + name + " a " + (($("#stockist").html() == 1) ? "Mobile" : "Center") + " Stockist?");
        }

        $("#modal-warning .proceed").attr("id", "set-stockist");
        $("#modal-warning .proceed").attr("data-stockist", $(this).data("stockist"));
        $("#modal-warning .proceed").attr("data-name", name);
        $("#modal-warning").modal("show");
    }
});

$(document).on("click", "#set-stockist", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");
    modalWarning.find("[data-bs-dismiss='modal']").css("display","none");

    let stockist = parseInt($("#set-stockist").attr("data-stockist"));
    let userId = (stockist === 0) ? $("#removable-accounts").val() : $("#assignable-accounts").val();
    let name  = $("#set-stockist").attr("data-name");
    let centerStockist = (stockist === 1) ? $("#assignable-center-stockists").val() : "";

    let data = {
        userId: userId,
        stockist: stockist,
        centerStockist: centerStockist,
        view: parseInt($("#stockist").html())
    };

    let url = $("#set-stockist-route").val();

    axios.post(url, data)
        .then((response) => {
            $("#users-table-container").html(response.data.content);

            initializeDataTables();

            let modalSuccess = $('#modal-success');
            modalSuccess.find(".message").html(name + " has been successfully " + ((stockist === 0) ? "removed" : "assigned") + " as " + ((parseInt($("#stockist").html()) === 1) ? "Mobile" : "Center") + " Stockist.");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find("[data-bs-dismiss='modal']").css("display","block");
            modalWarning.modal("hide");
        });
});

// Admin Winners Gem
$(document).on("click", ".approve-gem-purchase-show-modal", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".message").html("Winners Gem purchase request will now be approved.");
    modalWarning.find(".proceed").val($(this).val());
    modalWarning.find(".proceed").attr("id", "approve-gem-purchase");
    modalWarning.modal('show');
});

$(document).on("click", "#approve-gem-purchase", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");
    modalWarning.find("[data-bs-dismiss='modal']").css("display","none");

    let url = $("#approve-gem-purchase-route").val();
    let id = $(this).val();
    let data = {
        id: id
    };

    axios.post(url, data)
        .then((response) => {
            $("#winners-gem-table-container").html(response.data.content);

            initializeDataTables();

            let modalSuccess = $('#modal-success');
            modalSuccess.find(".message").html("Winners Gem purchase request successfully approved.");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find("[data-bs-dismiss='modal']").css("display","block");
            modalWarning.modal("hide");
        });
});

$(document).on("click", ".remove-gem-purchase-confirm", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".message").html("Winners Gem purchase request will now be removed.");
    modalWarning.find(".proceed").val($(this).val());
    modalWarning.find(".proceed").attr("id", "remove-gem-purchase");
    modalWarning.modal('show');
});

$(document).on("click", "#remove-gem-purchase", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");
    modalWarning.find("[data-bs-dismiss='modal']").css("display","none");

    let url = $("#remove-gem-purchase-route").val();
    let id = $(this).val();
    let data = {
        id: id
    };

    axios.post(url, data)
        .then((response) => {
            $("#winners-gem-table-container").html(response.data.content);

            initializeDataTables();

            let modalSuccess = $('#modal-success');
            modalSuccess.find(".message").html("Winners Gem purchase request successfully removed.");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find("[data-bs-dismiss='modal']").css("display","block");
            modalWarning.modal("hide");
        });
});

$(document).on("click", ".view-proof-of-payment", function() {
    $("#proof-of-payment-container").html('<p class="text-center" style="width:100%">No Proofs of Payment Added</p>');
    $("#account-name").html($(this).data("account"));
    $("#modal-proof-of-payment").modal("show");

    let proof_of_payments = JSON.parse($(this).find("span").html());

    let content = '';
    let i = 0;

    let load_image = function() {
        let img = new Image();

        img.onload = function() {
            content += '	<div class="col-6 px-1" style="margin-bottom:10px">';
            content += '		<a href="' + img.src + '" data-fancybox="images" data-caption="Proof of Payment">';
            content += '			<div class="background-image-contain proof-of-payment" style="width:100%; height:180px; background-color:#eeeeee; border:2px solid #0e4d22; position:relative; cursor:pointer; background-image:url(\'' + img.src + '\')"></div>';
            content += '		</a>';
            content += '	</div>';

            if(i === proof_of_payments.length - 1) {
                $("#proof-of-payment-container").html(content);
            } else {
                load_image(proof_of_payments[++i]);
            }
        };

        img.src = proof_of_payments[i];
    };

    if(proof_of_payments.length > 0) {
        load_image(proof_of_payments[i]);
    }
});

// Admin Orders
$(document).on("click", ".show-stockist", function() {
    $("#stockist-name").html($(this).data("name"));
    $("#stockist-rank").html(ranks[$(this).data("rank")]);
    $("#stockist-email-address").html($(this).data("email-address"));

    $('#modal-stockist').modal('show');
});

// Admin Items
$(document).on("submit", "#add-item-form", function(e) {
    e.preventDefault();

    let form = $(this);

    let modal = form.closest(".modal");
    modal.find("[data-bs-dismiss='modal']").addClass("d-none");

    let button = form.find("[type='submit']");
    button.html("Adding Item");
    button.prop("disabled", true);

    let url = form.attr("action");
    let data = new FormData(form[0]);

    axios.post(url, data)
        .then((response) => {
            modal.modal("hide")

            let modalSuccess = $('#modal-success');

            modalSuccess.attr("data-bs-backdrop", "static");
            modalSuccess.attr("data-bs-keyboard", "false");
            modalSuccess.find("[data-bs-dismiss='modal']").removeAttr("data-bs-dismiss");
            modalSuccess.find('.proceed').attr("onclick", "window.location = '" + response.data.redirect + "'; $('#modal-success .proceed').prop('disabled',true); $('#modal-success .proceed').html('Redirecting...')");

            modalSuccess.find(".message").html("Item added successfully.");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modal.find("[data-bs-dismiss='modal']").removeClass("d-none");

            button.html("Add Item");
            button.prop("disabled", false);
        });
});

$(document).on("submit", "#edit-item-form", function(e) {
    e.preventDefault();

    let form = $(this);

    let button = form.find("[type='submit']");
    button.html("Saving Changes");
    button.prop("disabled", true);

    let url = form.attr("action");
    let data = new FormData(form[0]);

    axios.post(url, data)
        .then((response) => {
            $("[name='photo']").val('');
            $("#photo-container").css("background-image", "url('" + response.data.photo + "')")

            let modalSuccess = $('#modal-success');
            modalSuccess.find(".message").html("Saving changes successful");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            button.html("Save Changes");
            button.prop("disabled", false);
        });
});

// Admin Withdrawals
$(document).on("click", ".view-payout-information", function() {
    var payout_information = JSON.parse($(this).find("span").html());

    var content = '	<table class="table table-bordered mb-0">';
    content += '		<tbody>';
    content += '			<tr>';
    content += '				<th style="background-color:#fafafa; text-align:right">Method</th>';
    content += '				<td style="text-align:left">' + payout_information.method + '</td>';
    content += '			</tr>';
    if(payout_information.method === "BDO") {
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Account Number</th>';
        content += '			<td style="text-align:left">' + payout_information.account_number + '</td>';
        content += '		</tr>';
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Account Name</th>';
        content += '			<td style="text-align:left">' + payout_information.account_name + '</td>';
        content += '		</tr>';
    } else if(payout_information.method === "Palawan Express") {
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Name</th>';
        content += '			<td style="text-align:left">' + payout_information.name + '</td>';
        content += '		</tr>';
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Mobile Number</th>';
        content += '			<td style="text-align:left">' + payout_information.mobile_number + '</td>';
        content += '		</tr>';
    } else if(payout_information.method === "GCash") {
        content += '			<tr>';
        content += '				<th style="background-color:#fafafa; text-align:right">Mobile Number</th>';
        content += '				<td style="text-align:left">' + payout_information.mobile_number + '</td>';
        content += '			</tr>';
    } else if(payout_information.method === "Coins.ph") {
        content += '		<tr>';
        content += '			<th style="background-color:#fafafa; text-align:right">Wallet Address</th>';
        content += '			<td style="text-align:left">' + payout_information.wallet_address + '</td>';
        content += '		</tr>';
    }
    content += '		</tbody>';
    content += '	</table>';

    $("#payout-information-container").html(content);

    $("#modal-payout-information").modal("show");
});

$(document).on("click", ".withdrawal-set-as-complete-confirm", function() {
    $("#modal-warning .message").html("Are you sure you want to set the withdrawal as complete?");
    $("#modal-warning .proceed").attr("id", "withdrawal-set-as-complete");
    $("#modal-warning .proceed").val($(this).val());
    $("#modal-warning").modal("show");
});

$(document).on("click", "#withdrawal-set-as-complete", function() {
    let modalWarning = $("#modal-warning");
    modalWarning.find(".proceed").prop("disabled",true);
    modalWarning.find(".proceed").html("Processing...");
    modalWarning.find("[data-bs-dismiss='modal']").css("display","none");

    let id = $(this).val();

    let data = new FormData();
    data.append('id', id);

    let url = $("#set-as-complete-route").val();

    axios.post(url, data)
        .then((response) => {
            $("#withdrawals-table-container").html(response.data.content);
            initializeDataTables();

            let modalSuccess = $('#modal-success');
            modalSuccess.find(".message").html("Withdrawal successfully set as complete.");
            modalSuccess.modal('show');
        }).catch((error) => {
            showRequestError(error);
        }).then(() => {
            modalWarning.find(".proceed").html("Confirm");
            modalWarning.find(".proceed").prop("disabled",false);
            modalWarning.find("[data-bs-dismiss='modal']").css("display","block");
            modalWarning.modal("hide");
        });
});
