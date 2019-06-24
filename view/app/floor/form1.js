document.getElementById('upper').addEventListener('focus', ()=>{
    document.getElementById('upper_radio').checked = true;
    document.getElementById('down_radio').checked = false;
    document.getElementById('down').value = "";
})

document.getElementById('down').addEventListener('focus', ()=>{
    document.getElementById('upper_radio').checked = false;
    document.getElementById('down_radio').checked = true;
    document.getElementById('upper').value = "";
})