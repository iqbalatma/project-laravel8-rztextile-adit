export default {
  formatIntToRupiah:(number)=>{
    return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ",00";
  },

  formatRupiahToInt:(rupiah)=>{
    let rupiahInt = rupiah.split(" ");
    rupiahInt = rupiahInt[1];
    rupiahInt = rupiahInt.replaceAll(".", "");
    rupiahInt = rupiahInt.split(" ")[0];
    rupiahInt = parseInt(rupiahInt);
    return rupiahInt;
  },

  preventEnter:(context, event)=>{
    if(event.key == "Enter"){
      event.preventDefault();
      $(context).blur();
    }
  },

  prenvetNonNumeric:(event)=>{
    if (event.which < 48 || event.which > 57) {
      event.preventDefault();
    }
  },

  preventTab:(context, event)=>{
    if (event.which == 9) {
      event.preventDefault();
      $(context).next().focus();
    }
  }

}
