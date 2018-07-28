var inventory=[[10,50],[14,100],[3,20],[18,150]];
var time_available=100;

hackFlipmart(time_available,inventory)

function hackFlipmart()
{
    var temp_inventory=[];
    for(var i=0;i<inventory.length;i++)
    {
        if(inventory[i][0]!=0 && inventory[i][1]!=0 && inventory[i][0]<=time_available)
          temp_inventory.push(Math.floor(time_available/inventory[i][0])*inventory[i][1]);
        
    } 
   
    
    console.log(temp_inventory)
    console.log(Math.max(...temp_inventory));
}