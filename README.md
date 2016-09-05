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
1,A1:color=#FF6164
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
==line
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

```
<switchpanel>
==text
Popup message information and link
==line:number=8
==line
1,AA
5,FO:case=fo,color="#80cc28",text="Green It Solutions",link="http://www.greenitsolutions.fr/"
==line
==line
</switchpanel>
```

## Text bar information

![](https://raw.github.com/GreenItSolutions/assets/master/dokuwiki/switchpanel/switchpanel_7.png)

### Example code :

```
<switchpanel>
==text
Text bar information
==line:number=8
==text:bgColor=#80cc28,color=#fff,size=20,brColor=#1D611F,brRadius=2
By Green It Solutions
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

## All options of "switchpanel"

```
<switchpanel
    logo="URL OF LOGO"
    logoLink="URL OF LINK"
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
 
==line:number=(number of cases),color=(backgroud color),case=(type of case)
1,label,title:color=(backgroud color),text=(text of popup message),link=(url of link),case=(type of case),target=(type of link target)

==text:bgColor=(backgroud color),color=(text color),size=(text size),brColor=(border color),brRadius=(border radius)

==heightBar:heigth=(height bar)

# this is a comment

</switchpanel>
```
