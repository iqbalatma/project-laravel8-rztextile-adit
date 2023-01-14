import { alertQuantityNotEnough } from "../../../module/alert";
import helper from "../../../module/helper";

  /**
   * Description : use to add behavior when button is click
   * 
   * @param {object} context context for button element
   */
  function onClickButtomRemove(context){
    let row = $(context).closest("tr");

    let tbody = $(row).parent().find("tr");
    
    let code = $(row).attr("class");

    let quantityRoll = parseInt($(row)
      .find(".quantity-roll")
      .text()
      .split(" ")[0])
    
    let quantityUnit = $(row)
      .find(".quantity-unit")
      .text()
      .split(" ");

    let unitName = quantityUnit[1];
    quantityUnit = parseInt(quantityUnit[0]);

    let availableRoll = parseInt($(row)
      .find(".available-quantity-roll")
      .text()
      .split(" ")[0]) + quantityRoll;

    let availableUnit = parseInt($(row)
      .find(".available-quantity-unit")
      .text()
      .split(" ")[0]) + quantityUnit;
    


    $(row)
      .parent() //tbody
      .children(`.${code}`) //all row that has same code
      .find(".available-quantity-roll") //column for availability quantity roll
      .text(`${availableRoll} roll`) //set text on column

    $(row)
      .parent() //tbody
      .children(`.${code}`) //all row that has same code
      .find(".available-quantity-unit") //column for availability quantity roll
      .text(`${availableUnit} ${unitName}`) //set text on column

    $(row).remove();

    if(tbody.length==1){
      button.hideButtonSummaryPayment();
    }
  }

  /**
   * Description : use to add behavior when button is click
   * @param {object} context context for button element
   */
  function onClickButtonMinus(context){
    let row = $(context).closest("tr");

    let tbody = $(row).parent().find("tr");

    let code = $(row).attr("class");

    let quantityRoll = parseInt($(row)
      .find(".quantity-roll")
      .text()
      .split(" ")[0]) - 1;

    let sellingPrice = helper.formatRupiahToInt($(row)
      .find(".selling-price")
      .text());

    let quantityUnitPerRoll = parseInt($(row)
      .find(".quantity-unit-per-roll")
      .text()
      .split(" ")[0]);

    let quantityUnit = $(row)
      .find(".quantity-unit")
      .text()
      .split(" ");
    
    let unitName = quantityUnit[1];
    quantityUnit = parseInt(quantityUnit[0]);

    let newQuantityUnit = quantityRoll * quantityUnitPerRoll;
    
    let newSubTotal = helper.formatIntToRupiah(sellingPrice * newQuantityUnit);

    let availableRoll = parseInt($(row)
      .find(".available-quantity-roll")
      .text()
      .split(" ")[0]) + 1;

    let availableUnit = parseInt($(row)
      .find(".available-quantity-unit")
      .text()
      .split(" ")[0]) + (1*quantityUnitPerRoll);

    $(row)
      .find(".quantity-roll")
      .text(`${quantityRoll} roll`);

    $(row)
      .find(".quantity-unit")
      .text(`${newQuantityUnit} ${unitName}`);

    $(row)
      .find(".sub-total")
      .text(newSubTotal);
    
    $(row)
      .parent() //tbody
      .children(`.${code}`) //all row that has same code
      .find(".available-quantity-roll") //column for availability quantity roll
      .text(`${availableRoll} roll`) //set text on column
    
    $(row)
      .parent() //tbody
      .children(`.${code}`) //all row that has same code
      .find(".available-quantity-unit") //column for availability quantity roll
      .text(`${availableUnit} ${unitName}`) //set text on column
    
    if(quantityRoll==0){
      $(row).remove();
      if(tbody.length==1){
        button.hideButtonSummaryPayment()
      }
    }
  }

    /**
   * Description : use to add behavior when button is click
   * 
   * @param {object} context context for button elemen
   */
  function onClickButtonPlus(context){
    let row = $(context).closest("tr");

    let code = $(row).attr("class");

    let sellingPrice = helper.formatRupiahToInt($(row)
      .find(".selling-price")
      .text());

    let quantityRoll = parseInt($(row)
      .find(".quantity-roll")
      .text()
      .split(" ")[0]) + 1;
    
    let quantityUnitPerRoll = parseInt($(row)
      .find(".quantity-unit-per-roll")
      .text()
      .split(" ")[0]);

    let quantityUnit = $(row)
      .find(".quantity-unit")
      .text()
      .split(" ");
    
    let unitName = quantityUnit[1];
    quantityUnit = parseInt(quantityUnit[0]);

    let newQuantityUnit = quantityRoll * quantityUnitPerRoll;

    let newSubTotal = helper.formatIntToRupiah(sellingPrice * newQuantityUnit);

    let availableRoll = parseInt($(row)
      .find(".available-quantity-roll")
      .text()
      .split(" ")[0]) - 1;

    let availableUnit = parseInt($(row)
      .find(".available-quantity-unit")
      .text()
      .split(" ")[0]) - (1*quantityUnitPerRoll);

    if(availableRoll<0 || availableUnit <0){
      return alertQuantityNotEnough();
    }

    $(row)
      .find(".quantity-roll")
      .text(`${quantityRoll} roll`);

    $(row)
      .find(".quantity-unit")
      .text(`${newQuantityUnit} ${unitName}`);

    $(row)
      .find(".sub-total")
      .text(newSubTotal);
    
    $(row)
      .parent() //tbody
      .children(`.${code}`) //all row that has same code
      .find(".available-quantity-roll") //column for availability quantity roll
      .text(`${availableRoll} roll`) //set text on column
    
    $(row)
      .parent() //tbody
      .children(`.${code}`) //all row that has same code
      .find(".available-quantity-unit") //column for availability quantity roll
      .text(`${availableUnit} ${unitName}`) //set text on column
  }

const button =  {
  /**
   * Description : use to show button summary payment
   * 
   */
  showButtonSummaryPayment(){
    $("#btn-summary-payment").removeClass("d-none");
  },

  hideButtonSummaryPayment(){
    $("#btn-summary-payment").addClass("d-none");
  },

  /**
   * Description : use to add button plus on column action
   * 
   * @returns html element for button plus
   */
  getButtonPlusElement(){
    return $("<button>",{
      class:"btn btn-primary btn-sm btn-plus-roll",
      type: "button",
      click: function(){
        onClickButtonPlus(this);
      }
    }).append($("<i>",{
      class:"fa-solid fa-square-plus"
    }));
  },

  /**
   * Description : use to get button minus element
   * 
   * @returns html elemen of button minus
   */
  getButtonMinusElement(){
    return $("<button>",{
      class: "btn btn-danger btn-sm btn-minus-roll",
      type: "button",
      click: function(){
        onClickButtonMinus(this);
      }
    }).append($("<i>",{
      class: "fa-solid fa-square-minus"
    }));
  },

  /**
   * Description : use to get html element for remove button
   * 
   * @returns html element
   */
  getButtonRemoveElement(){
    return $("<button>",{
      class: "btn btn-danger btn-sm btn-delete-roll",
      type : "button",
      click: function(){
        onClickButtomRemove(this);
      }
    }).append($("<i>",{
      class:"fa-solid fa-trash"
    }));
  },
}

export default button;