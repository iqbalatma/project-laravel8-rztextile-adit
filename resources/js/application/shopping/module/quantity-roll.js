import { alertQuantityNotEnough } from "../../../module/alert";
import helper from "../../../module/helper";

const tempData = {
  value:null,

  setValue: function(value){
    this.value = value;
  },

  getValue: function(){
    return this.value;
  }
}

function onClickQuantityRoll(context){
  tempData.setValue(parseInt($(context).text()))
  $(context).text(parseInt($(context).text()));
}

function onBlurQuantityRoll(context, unitName){
  let row = $(context).closest("tr");

  let quantityRoll = parseInt($(row).find(".quantity-roll").text());
  let quantityUnit = parseInt($(row).find(".quantity-unit").text());
  let unitPerRoll = parseInt($(row).find(".quantity-unit-per-roll").text());
  let sellingPrice = helper.formatRupiahToInt($(row).find(".selling-price").text());
  let availableQuantityRoll = parseInt($(row).find(".available-quantity-roll").text());
  let availableQuantityUnit = parseInt($(row).find(".available-quantity-unit").text());

  let newQuantityUnit = quantityRoll * unitPerRoll;
  let newSubTotal = sellingPrice * newQuantityUnit;
  let diffrenceUnit = newQuantityUnit - quantityUnit;
  let diffrenceRoll = quantityRoll - tempData.getValue();
  let newAvailableQuantityUnit = availableQuantityUnit - diffrenceUnit;
  let newAvailableQuantityRoll = availableQuantityRoll - diffrenceRoll;

  if(newAvailableQuantityUnit<0 || newAvailableQuantityRoll<0){
    $(context).text(`${tempData.getValue()} roll`);
    if(tempData.getValue()!=quantityRoll){
      return alertQuantityNotEnough();
    }
    return false;
  }

  $(row).find(".quantity-roll").text(`${quantityRoll} roll`)
  $(row).find(".sub-total").text(`${helper.formatIntToRupiah(newSubTotal)}`)
  $(row).find(".available-quantity-unit").text(`${newAvailableQuantityUnit} ${unitName}`)
  $(row).find(".available-quantity-roll").text(`${newAvailableQuantityRoll} roll`)
  $(row).find(".quantity-unit").text(`${newQuantityUnit} ${unitName}`)
}

function onKeyPressQuantityRoll(context, event){
  helper.preventEnter(context, event);
  helper.prenvetNonNumeric(event);
}

function onKeyDownQuantityRoll(context, event){
  helper.preventTab(context, event);
}

function onFocusQuantityRoll(context){
  $(context).text(`${parseInt($(context).text())}`);
}


export default {
  getQuantityRollElement(unitName){
    return $(`<td>`,{
      text: "1 roll",
      class: "text-nowrap quantity-roll",
      attr:{
        contenteditable:true
      },
      click: function(){
        onClickQuantityRoll(this);
      },
      blur: function(){
        onBlurQuantityRoll(this, unitName);
      },
      focus: function(){
        onFocusQuantityRoll(this)
      },
      keypress: function(event){
        onKeyPressQuantityRoll(this, event);
      },
      keydown: function(event){
        onKeyDownQuantityRoll(this, event)
      }
    });
  }
}