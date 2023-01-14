import helper from "../../module/helper"
import button from "./module/button";
import confirmShopping from "./module/confirm-shopping";
import quantityRoll from "./module/quantity-roll";
import sellingPrice from "./module/selling-price";
import unitPerRoll from "./module/unit-per-roll";



/**
 * Description : use to get all total quantity unit selected option on table
 * 
 * @param {string} code 
 * @returns 
 */
function getCurrentTotalUnitOnTable(code){
  let row = $(`.${code}`);

  let totalUnit = 0;
  if(row.length>0){
    row.each(function(){
      let subTotalunit = $(this).find(".quantity-unit").text();
      subTotalunit = parseInt(subTotalunit.split(" ")[0]);
      totalUnit += subTotalunit;
    });
  }

  return totalUnit;
}

/**
 * Description : use to get all total quantity roll selected option on table
 * 
 * @param {string} code 
 * @returns int 
 */
function getCurrentTotalRollOnTable(code){
  let row = $(`.${code}`);

  let totalRoll = 0;
  if(row.length>0){
    row.each(function(){
      let subtotalRoll = $(this).find(".quantity-roll").text();
      subtotalRoll = parseInt(subtotalRoll.split(" ")[0]);
      totalRoll += subtotalRoll;
    });
  }

  return totalRoll;
}

/**
 * Description : use to update available quantity roll when add new row
 * 
 * @param {string} code code of roll that selected on selectize
 * @param {int} availableRoll available roll that want to setup
 */
function updateAvailableQuantityRoll(code,availableRoll){
  let row = $(`.${code}`);

  if(row.length>0){
    row.each(function(){
      $(this).find(".available-quantity-roll").text(availableRoll + " roll");
    });
  }
} 

/**
 * Description : use to update available quantity unit when add new row
 * 
 * @param {string} code 
 * @param {int} availableRoll 
 * @param {string} unitName 
 */
function updateAvailableQuantityUnit(code,availableRoll,unitName){
  let row = $(`.${code}`);

  if(row.length>0){
    row.each(function(){
      $(this).find(".available-quantity-unit").text(availableRoll + ` ${unitName}`);
    });
  }
} 



/**
 * Description : selectize option configuration
 */
const selectizeOption = {
  create: false,
  sortField: "text",
  openOnFocus: false,
  render: {
      option: function(data, escape) {
          return `<div class="item-roll-selectized"
                      data-id="${escape(data.data.id)}"
                      data-data="${escape(JSON.stringify(data.data))}">
                      ${escape(data.text)}
                  </div>`
      }
  },
  onChange: function(value) {
    onChangeSelectize(value)
  }
}

$(document).ready(function(){
  /**
   * Description : use to clear and always focus on selectize
   * 
   * @param {object} selectized initialize of selectize
   */
  function selectizedFocusAndClear(selectized) {
    selectized =  selectized[0].selectize;
    selectized.focus();
    selectized.off();
    selectized.clear();
    selectized.on("change", function(value) {
        onChangeSelectize(value);
    });
  }


  // initialize selectize 
  let selectized = $("#select-roll").selectize(selectizeOption);

  selectizedFocusAndClear(selectized);

  /**
   * Description : function that will execute on change selectize
   * 
   * @param {int} value 
   */
  function onChangeSelectize(value) {
    const rollId = value;
    const dataSet =$(`.item-roll-selectized[data-id="${rollId}"]`).data("data"); 

    setSelectedOptionToTableRow(dataSet);
  }

  /**
   * Description : use to add and draw row table
   * 
   * @param {object} dataSet 
   */
  function setSelectedOptionToTableRow(dataSet){
    button.showButtonSummaryPayment();
    let table = $("#table-product");
    let tbody = $(table).find("tbody");

    let totalUnitOnTable = getCurrentTotalUnitOnTable(dataSet.code);
    let totalRollOnTable = getCurrentTotalRollOnTable(dataSet.code)

    let tr = $("<tr>",{
      class: dataSet.code
    });

    tr.append($(`<td>${dataSet.id}</td>`));
    tr.append($(`<td>${dataSet.code}</td>`));
    tr.append($(`<td>${dataSet.name}</td>`));
    tr.append(quantityRoll.getQuantityRollElement(dataSet.unit.name));
    tr.append(unitPerRoll.getUnitPerRollElement(dataSet.unit.name));
    tr.append($(`<td>`,{
      text: `1 ${dataSet.unit.name}`,
      class: "text-nowrap quantity-unit",
    }));
    tr.append(sellingPrice.getSellingPriceElement(dataSet.selling_price));
    tr.append($(`<td>`,{
      text: helper.formatIntToRupiah(dataSet.selling_price),
      class: "text-nowrap sub-total"
    }));

    tr.append($("<td>",{
      class:"text-nowrap action-roll"
    }).append($("<div>",{
      class: "d-grid gap-2 d-md-block"
    })
    .append(button.getButtonPlusElement())
    .append(button.getButtonMinusElement())
    .append(button.getButtonRemoveElement())
    ));

    tr.append($(`<td>`,{
      text: `${dataSet.quantity_roll} rolls`,
      class: "text-nowrap available-quantity-roll"
    }));

    tr.append($(`<td>`,{
      text: `${dataSet.quantity_unit} ${dataSet.unit.name}`,
      class: "text-nowrap available-quantity-unit"
    }));

    tbody.append(tr);

    updateAvailableQuantityRoll(
      dataSet.code,
      (dataSet.quantity_roll-1-totalRollOnTable)
    );
    updateAvailableQuantityUnit(
      dataSet.code,
      (dataSet.quantity_unit-1-totalUnitOnTable),
      dataSet.unit.name
    );
    selectizedFocusAndClear(selectized);
  }

  $("#btn-summary-payment").on("click", function(){
    let summaryPaymentContainer = $("#summary-payment-container");

    $(summaryPaymentContainer).children().remove();

    $("#table-product")
      .clone()
      .appendTo($(summaryPaymentContainer))
      .attr("id", "table-summary-product")
      .find(".action-roll, .action-roll-header")
      .remove();

    let totalBill = 0;
    $("#table-summary-product").find(".sub-total").each(function(){
      let subTotal = helper.formatRupiahToInt($(this).text());
      totalBill += subTotal;
    });

    $("#total-bill").val(helper.formatIntToRupiah(totalBill));
  });

  $("#is-with-customer").on("change", function(){
    if(this.checked){
      $("#customer-container-modal").removeClass("d-none");
    }else{
      $("#customer-container-modal").addClass("d-none");
    }
  })

  $("#select-customer").on("change", function(){
    let dataCustomer = $(this).find("option:selected").data("json");

    $("#id_number").val(dataCustomer["id_number"])
    $("#name").val(dataCustomer["name"])
    $("#address").val(dataCustomer["address"])
    $("#phone").val(dataCustomer["phone"])
  })

  $("#btn-confirm-shopping").on("click", function(){
    confirmShopping.onClickConfirm();
  });
});