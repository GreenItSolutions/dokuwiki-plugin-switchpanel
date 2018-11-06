# Dokuwiki Switch Panel Plugin

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_1.png)

## Coloring networks

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_2.png)

### Example code :

```
<switchpanel>
==text
Coloring networks
==line
1,Aa:color=#FF6164
2,B1:color=#FF61ED
3,C1:color=#9361FF
4,D1:color=#6176FF
5,E1:color=#61FCFF
6,note,FO:color=#61FF88
7:case=none
8,A2:color=#C0FF61
9,B2:color=#FFDA61
10,C2:color=red
</switchpanel>
```


## Coloring labels

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_12.png)

### Example code :

```
<switchpanel>
==text
Coloring labels
==line
1,A1:labelBgColor=#FF6164
2,B1:labelTxtColor=#FF61ED
3,C1:labelBgColor=#9361FF,labelTxtColor=#61FF88
4,D1:labelBgColor=red
5,E1:labelBgColor=black,labelTxtColor=white
</switchpanel>
```

## Coloured RJ45 LEDs

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_13.png)

### Example code :

```
<switchpanel>
==text
Link Speed &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; POE Payload
==line:number=9
1,OFF
2,10M:leftLedColor=red
3,100M:leftLedColor=yellow
4,1G:leftLedColor=lime
5,10G:leftLedColor=blue
6:case=none
7,OFF
8,24V:leftLedColor="#666666",rightLedColor=orange
9,48V:leftLedColor="#666666",rightLedColor=lime
</switchpanel>
```

### Exemple usage :

the leftLedColor is:

* OFF : “#666666”(default if no value)
* 10M : red
* 100M : yellow
* 1G : lime
* 10G : blue

And the rightLedColor is :

* OFF : no POE (default if no value)
* 24V : orange
* 48V : lime


## All types cases

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_3.png)

### Example code :

```
<switchpanel>
==text
All types cases
==line
1,rj45:case=rj45
2,of:case=of
3,2of:case=2of
4,gbic:case=gbic
5,none:case=none
6,serial:case=serial
7,close:case=close
</switchpanel>
```

## No ears display

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_4.png)

### Example code :

```
<switchpanel showEars="false">
==text
No ears display
==line:number=8
2,of,of:case=of
==line:number=8
2,foo,bar
</switchpanel>
```

## Height separator

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_5.png)

### Example code :

```
<switchpanel showEars="false">
==text
Height separator
==line:number=8
2,of,of:case=of
==line
==heightBar
==line
1:case=none
6:case=none
==heightBar:height=20
==line
</switchpanel>
```

## Popup message information and link

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_6.png)

### Example code :

<switchpanel>
==text
Popup message information and link
==line:number=8
1,1:text="Hello World",link="https://greenitsolutions.fr/",textlink="GreenITSolutions website"
8,8:text="<b>From:</b> Office Level, Netgear switch port 1<br><b>To:</b> HP switch port 18<br><b>Speed:</b> 10G <hr> Additional information",link="https://greenitsolutions.fr/",textlink="Documentation"
==line
==line
==line
==line
</switchpanel>
```

You can use HTML tags in the text field for layout :

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_14.png)

## Text bar information

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_7.png)

### Example code :

```
<switchpanel>
==text
Text bar information
==line:number=8
==text:bgColor=#80cc28,color=#fff,size=16,brColor=#1D611F,brRadius=2
By Green IT Solutions
==line
</switchpanel>
```

## Screw style

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_8.png)

### Example code :

```
<switchpanel screwHeightSpace="30" screwHeight="8" screwWidth="10" screwColor="#80cc28">
==text
Screw style
==line:number=8
==line
==line
==line
</switchpanel>
```

## Hide logo

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_9.png)

### Example code :

```
<switchpanel logo=none>
==text
Hide logo
==line:number=8
==line
</switchpanel>
```

## Group ports

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_10.png)

### Example code :

```
<switchpanel group="6">
==line:number=12
1,PC1
2,PC2
3,PC3
6,??
==line
1,AB
</switchpanel>
```

## Label line

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_11.png)

### Example code :

```
<switchpanel group="6">
==line:number=12,labelLeft=01,labelRight=A1,colorLabelRight=#FF6164
1,PC1
2,PC2
3,PC3
6,??
==line:labelLeft=02
1,AB
</switchpanel>
```

## All options of "switchpanel"

```
<switchpanel
    logo="URL OF LOGO"
    logoLink="URL OF LINK"
    labelBgColor="#fff"
    labelTxtColor="#000"
    leftLedColor="#00ff00"
    rightLedColor="#666666"
    target="_blank"
    showEars=true / false
    case="rj45" (case a default)
    group="0"
    groupSeparatorWidth="18"
    color="#ccc" (case color default)
    elementWidth="36"
    elementHeight="45"
    elementSeparatorWidth="5"
    elementSeparatorHeight="5"
    textSize="20"
    textColor="#fff"
    textBgColor="" (no default background color defined)
    textBrColor=""
    textBrRadius=""
    barHeight="5"
    screwHeightSpace=60
    screwHeight=15
    screwWidth=20
    screwColor="#fff"
    switchColor="#808080" (backgroud color default)
    >

==line:number=(number of cases),color=(backgroud color of the line case),case=(type of the line case),labelLeft=(label left of the line),labelRight=(label right of the line),colorLabelLeft=(color of label left),colorLabelRight=(color of label right),labelBgColor=(background color of the case label),labelTxtColor=text color of the case label),leftLedColor=(color of the left LED),rightLedColor(color of the right LED)

==text:bgColor=(backgroud color),color=(text color),size=(text size),brColor=(border color),brRadius=(border radius)

==heightBar:heigth=(height bar)

1,label,title:color=(backgroud color),text=(text of popup message),link=(url of link),case=(type of case),target=(type of link target),labelBgColor=(background color of the case label),labelTxtColor=text color of the case label),leftLedColor=(color of the left LED),rightLedColor(color of the right LED)

# this is a comment

</switchpanel>
```
