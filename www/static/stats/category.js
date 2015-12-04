var categoryArray = new Array();
categoryArray[0] = new Array("全部","全部;尊享特惠;基地;资源战;竞技场;资源;联盟;每日特购;砸蛋;修复;建筑加速;科技加速;造兵加速;乐透抽奖;大转盘;保护;武器中心;特训;祭坛抽取;购买英雄;VIP;月卡");
var category2Array = new Array(); 
category2Array[0] = new Array("全部",",全部");
category2Array[1] = new Array("尊享特惠","9TS1,尊享特惠第1期;9TS2,尊享特惠第2期;9TS3,尊享特惠第3期;9TS4,尊享特惠第4期;9TS5,尊享特惠第5期;9TS6,尊享特惠第6期;9TS7,尊享特惠第7期;9TS8,尊享特惠第8期;9TS9,尊享特惠第9期");
category2Array[2] = new Array("基地","ALIASC,修改名字;BIP,资源压缩;BLK2,2级围墙;BLK3,3级围墙"); 
category2Array[3] = new Array("资源战","BMOT,延长矿的占领时间"); 
category2Array[4] = new Array("竞技场","BPKT,竞技场加次数;CPKCD,竞技场清CD;BPK2T,跨服竞技场加次数;CPK2CD,跨服竞技场清CD;RPKR,竞技场刷新对手");
category2Array[5] = new Array("资源","BR11,金属10%;BR12,金属50%;BR13,金属100%;BR21,石油10%;BR22,石油50%;BR23,石油100%;BRBUY,资源快捷购买;POD,资源生产催化");
category2Array[6] = new Array("联盟","BUF,购买联盟徽记;UNCTRIB,联盟贡献;IP,弹劾联盟盟主"); 
category2Array[7] = new Array("每日特购","CTP,每日特购;CTP2,每日特购2"); 
category2Array[8] = new Array("砸蛋","EGGF,砸蛋-刷新;EGGP1,砸蛋-透视1;EGGP2,砸蛋-透视2;EGGS1,砸蛋-砸1;EGGS2,砸蛋-砸2;EGGS3,砸蛋-砸3"); 
category2Array[9] = new Array("修复","FIX,建筑全部修复");
category2Array[10] = new Array("建筑加速","ITP,炮塔加速;MF,地雷加速;SP4,建筑加速;INSTANT,直接加速;CCSP,使用卡片和游戏币加速"); 
category2Array[11] = new Array("科技加速","IU,科技加速"); 
category2Array[12] = new Array("造兵加速","IUP,造兵加速;UPOD,兵营催化"); 
category2Array[13] = new Array("乐透抽奖","LOTBN,每日抽奖;LOTRF,抽奖刷新"); 
category2Array[14] = new Array("大转盘","LTR,大转盘抽奖1次;LTR10,大转盘抽奖10次"); 
category2Array[15] = new Array("保护","PRO1,保护1;PRO2,保护2;PRO3,保护3"); 
category2Array[16] = new Array("武器中心","RD,研发1次;RD10,研发10次;RD50,研发50次"); 
category2Array[17] = new Array("特训","TB,特训书快捷购买;TB1,特训书1本;TB10,特训书10本");
category2Array[18] = new Array("祭坛抽取","LH1,抽取1次;LH3,抽取3次");
category2Array[19] = new Array("购买英雄","BHREO,BHREO;BHERO2,BHERO2"); 
category2Array[20] = new Array("VIP","VIP1,VIP1;VIP2,VIP2;VIP3,VIP3;VIP4,VIP4;VIP5,VIP5;VIP6,VIP6;VIP7,VIP7");
category2Array[21] = new Array("月卡","MONTH_CARD,月卡"); 
		function initcategory(category,category2){
			getcategory('全部',category);
			getcategory2(category,category2);
		}
         function getcategory(currcategory,s) 
         { 
             var i,j,k,l=0; 
            var category =document.getElementById('category_big');
            category.length = 0 ;       
             for (i = 0 ;i <categoryArray.length;i++) 
               {    
                  
                   if(categoryArray[i][0]==currcategory) 
                     {    
                         
                        tmpcategoryArray = categoryArray[i][1].split(";"); 
                           for(j=0;j<tmpcategoryArray.length;j++) 
                           { 
								var opt = tmpcategoryArray[j]; 
                        	    category.options[category.length] = new Option(opt,j);
                        	    if(s!=null && j==s){
                        		  l=j;
                        	   }

                        	 } 
                      }                
                }
             category.options[l].selected="selected";

         }
         function getcategory2(currcategory,s) 
         { 
            
             var i,j,k,l=0; 
             //清空 城市 下拉选单 
            var category2 =  document.getElementById('category2');
            category2.length = 0 ;    
            tmpcategoryArray = categoryArray[0][1].split(";"); 
            currcategory = tmpcategoryArray[currcategory]
            for (i = 0 ;i <category2Array.length;i++) 
               {    
                   //得到 当前省 在 城市数组中的位置 
                   if(category2Array[i][0]==currcategory) 
                     {    
                          var all="";
                         //得到 当前省 所辖制的 地市 
                           tmpcategory2Array = category2Array[i][1].split(";"); 
                           for(j=0;j<tmpcategory2Array.length;j++) 
                           {  
				   var opt = tmpcategory2Array[j].split(",");
				   index =j;
				   if(opt[0]!=""){
                   	   		all = all+opt[0]+",";
                   	   		index = j+1;
                   	  	   }
                        	   category2.options[index] = new Option(opt[1],opt[0]);
                        	   if(s!=null && opt[0]==s){
                        		  l=index;
                        	   }
                           }
                           if(all !=""){
	                           	all = all.substring(0,all.length-1);
	                          	category2.options[0] =  new Option('全部',all);
                          }
                     }                
                } 
            category2.options[l].selected="selected";
         }