# Google Apps Script Complete Course Beginner to Advanced

## Section 1: Introduction to using Google Script

### Introduction to Google Script

The Google services include calendar, contacts, document, drive, form, gmail, language, maps,...
And the great thing about it is you can combine these together and create even more amazing functionality

### Quick start to Google App Script

What is App Script?

- Javascript based scripting language
- Connecting functionality of Google Apps, like documents, spreadsheets, email, drive and more
- Create and customize how they function
- Comes with its own online IDE
- Can be used as a standalone or bound within Google applications

[Doc](https://developers.google.com/apps-script)

What can App Script do?

- Add menus to Google Docs, Sheets and forms
- Add custom functions to Google Sheets
- Create and publish web apps
- Save time on repetitive task
- Use data contained in google suite and do stuff with it
- Complex forms - use sheets as a database
- Interact weith a wide variety of Google Services, Docs, Sheets, Drive, Gmail, FOrms, Maps, Calendar, Sites
- You can do a lot - only limited by your imagination
- Build full featured lightweight web applications
- Code in a specialized version of Javascript customized to access G Suite, and other Google or external services (URLFetch, JDBC, etc.)
- Do not have to host your app - it lives and runs on Google servers in the cloud

### Getting started with Apps Script

- All you need is a Google account
- Fundamental JS knowledge  
- Sign in to [App Scripts](https://script.google.com/honme)

There are 2 types of scripts:

- `bound`: it's forever (and only) tied to one Google document (Doc, Sheet, Slide, Site, or Form)
- `standalone`: an independent script not tied to any G Suite documents

### Publishing Scripts

Bound and standalone apps can also be published to expose more broadly:

- Not published - remains private, acessible only to project owners
- Published as an add-on - your app can be installed from the add-on store
- Published as web app - your app handles HTTP request and has web UI components
- Embedded in Google Sites - published web apps can be embedded in either the new Sites or classic Sites pages
- Published as an API executable - your app can be accessed through the Execution API
- Some valid combination of the above

### App Script Power Example

- Create new Google Docs
- Append to it some content
- Send notification email with the link of the Docs

```js
    function myFunction() {
        // create new google docs and append some content
        var doc = DocumentApp.create('New Doc');
        var body = doc.getBody();
        body.appendParagraph('Hello World');

        // send email
        var email = Session.getActiveUser().getEmail();
        var subject = doc.getName();
        var bodyEmail = 'This is the new doc = ' + doc.getUrl();
        GmailApp.sendEmail(email, subject, bodyEmail); 
    }
```

### First Script using online IDE and Google Script

First script:

- Debugging and running script
- Project properties under File

Classes - Apps Script

- Listing of services starting with the Calendar Service
- Each service has classes, attribute and methods associated with them
- [Doc](https://developers.google.com/apps-script/reference)

Document App

- Properties and methods within the DocumentApp class
- Create document within scripts
- Review options for documents
- [Doc](https://developers.google.com/apps-script/reference/document)

Create new function

```js
function firstapp() {
    var welcomemessage = 'hello world';
}
```

Loop & Log

```js
function firstapp() {
    var welcomemessage = 'hello world';

    for (var x = 0; x < 10; x++) {
        Logger.log(welcomeMessage);
    }
}
```

Getting started with Calendar service

- [Doc](https://developers.google.com/apps-script/reference/calendar)

Getting started with Document service

- [Doc](https://developers.google.com/apps-script/reference/document)

- DocumentApp class
- Methods: create, getActiveDocument(),...

```js
function createDoc() {
    // create new document (Google Doc)
    var doc = DocumentApp.create('New Test Doc');
}

function updateDoc() {
    var doc = DocumentApp.openById('document_id');
    Logger.log(doc.getName());
}
```

## Section 3: Google DocumentApp

### Explore Document - Class `DocumentApp`

- Open: `DocumentApp.openById()`
- Get body object: `doc.getBody()`
- Add some content: `body.appendParagraph('content')`

```js
var doc = DocumentApp.openById('...');
var body = doc.getBody();
body.appendParagraph('Content');
body.appendPageBreak();
```

Get Document Content

```js
function getDoc() {
    var doc = DocumentApp.openById('...');
    var body = doc.getBody();

    var selection = body.getText();
    Logger.log(selection);

    // translate
    var spanish = LanguageApp.translate(selection, 'en', 'es');
    Logger.log(spanish);

    // append
    body.appendParagraph(spanish);
}
```

Document Body Contents

```js
function getParagraph() {
    var doc = DocumentApp.openById('...');
    var body = doc.getBody();

    // get first paragraph
    var paragraph1 = body.getChild(0);

    Logger.log(paragraph1.getText());

    // change text
    paragraph1.setText('CHANGED');
    paragraph1.setFontSize(50);
}
```

### Document Body

Document Body Updates

```js
function getParagraph() {
    var doc = DocumentApp.openById('...');
    var body = doc.getBody();

    var paraList = body.getParagraphs();
    Logger.log(paraList[0].getText());
    paraList[0].appendText('Append');

    var a = paraList[0].getAttributes();
    Logger.log(a);
}
```

Get & set attributes

```js
function getParagraph() {
    var doc = DocumentApp.openById('...');
    var body = doc.getBody();

    var paraList = body.getParagraphs();
    Logger.log(paraList[0].getText());
    paraList[0].appendText('Append');

    var a = paraList[0].getAttributes();
    Logger.log(a);

    var style = {}
    style[DocumentApp.Attribute.FONT_FAMILY] = 'Calibri';
    paraLIst[0].setAttributes(style);
}
```

Document body children

```js
function getParagraph() {
    var doc = DocumentApp.openById('...');
    var body = doc.getBody();

    Logger.log(body.getNumChildren());

    for (var x = 0; x < body.getNumChildren(); x++) {
        var el = body.getChild(x);

        if (el.getType() == 'PARAGRAPH') {
            Logger.log(el.getText());
        }
    }
}
```

### Document classes and methods

```js
var doc = DocumentApp.openById('...');
var body = doc.getBody();

var att = {
    'FOREGROUND_COLOR': '#ffff00',
    'BOLD': true
}

for (var x = 0; x < body.getNumChildren(); x++) {
    var el = body.getChild(x);
    el.setAttributes(att);

    var text = el.editAsText();
    Logger.log(text.length);

    // dynamic style
    // text.setForegroundColor(0, text.getText().length/2, '#FF0000');
    // text.setBackgroundColor(text.getText().length/2, text.getText().length-1, '#FF0000');
}
```

### Simple Copy Doc Script

```js
function copyDoc() {
    var srcDoc = DocumentApp.openById('...');
    var tarDoc = DocumentApp.openById('...');

    var srcDocTotal = srcDoc.getNumChildren();
    var tarDocBody = tarDoc.getBody();

    // clear content | get blank page
    tarDocBody.clear();
    tarDocBody.appendParagraph('Last Updated ' + Date()).setFontSize(8).appendHorizontalRule();

    for (var x = 0; x < srcDocTotal; x++) {
        var el = srcDoc.getChild(x).copy();
        var elType = el.getType();

        if (elType == DocumentApp.ElementType.PARAGRAPH) {
            tarDocBody.appendParagraph(el);
        } else if (elType == DocumentApp.ElementType.LIST_ITEM) {
            tarDocBody.appendListItem(el);
        } else if (elType == DocumentApp.ElementType.TABLE) {
            tarDocBody.appendTable(el);
        }
    }
}
```

### DocumentApp Bound Script

Script that bounds to a specific application.

To create a Google Doc Script:

- Open Google Doc
- Menu Tool > Script
- Write bound script

Some useful hooks:

- `onOpen`: fire when the associated doc open

Get user interface and makes change to the UI

- `getUi()`
- Add alert with `ui.alert()`
- Add prompt
- Add dialog with custom HTML

HTMLService

- Raw string: `createHtmlOutut(string)`
- From HTML file: `createHtmlOutputFromFile(index)` (index.html)

Access current session and get some user information

- `Session.getActiveUser().getEmail()`
- Get locale
- Get time zone

```js
// bound script
function onOpen() {
    Logger.log('Document is just opened');

    // change UI 
    DocumentApp.getUi()
        .createMenu('Advanced')
        .addItem('One', 'myFunc1')
        .addItem('Tne', 'myFunc2')
        .addSeperator()
        .addItem('Three', 'myFunc3')
        .addItem('Four', 'myFunc4')
        .addItem('Five', 'myFunc5')
        .addToUi();
}

function myFunc1() {
    var ui = DocumentApp.getUi();
    ui.alert('Function #1');

    var result = ui.alert('Are you logged in?', ui.ButtonSet.YES_NO_CANCEL);
    ui.alert('You responded with ' + result);
}

function myFunc2() {
    Logger.log('Function #2');
    var email = Session.getActiveUser().getEmail();

    var ui = DocumentApp.getUi();
    ui.alert('Your email ' + email);
}

function myFunc3() {
    Logger.log('Function #3');
    var ui = DocumentApp.getUi();
    var response = ui.prompt('Getting to know you', 'May I know your name?', ui.ButtonSet.YES_NO);

    ui.alert('Your name ' + response.getResponseText());
}

function myFunc4() {
    Logger.log('Function #4');
    var locale = Session.getActiveUserLocale();
    var timezone = Session.getScriptTimeZone();

    var ui = DocumentApp.getUi();
    ui.alert('Your locale ' + locale);
    ui.alert('Your timezone ' + timezone);
}

function myFunc5() {
    Logger.log('Function #5');

    var htmlOutput = HtmlService
        .createHtmlOutput('<p>A change of speed, a change of style...</p>')
        .setWidth(250)
        .setHeight(300);

    DocumentApp.getUi().showModalDialog(htmlOutput, 'My add-on');
}
```

Get the document to which this script is bound

- Get current document
- Jump to the position of the cursor
- Insert some text

```js
function myFunction() {
    var doc = DocumentApp.getActiveDocument();
    var cursor = doc.getCursor(); 

    cursor.insertText(Date());

    var docId = doc.getId();
    Logger.log(docId);
}
```

Get selection and do something with it

```js
    var selection = DocumentApp.getActiveDocument().getSelection();
    if (!selection) {
        return
    }

    var el = selection.getRangeElements();
    DocumentApp.getUi().alert('Number of selected elements ' + el.length);

    for (var x = 0; x < el.length; x++) {
        if (el[x].getElement().editAsText) {
            var holder = el[x].getElement().editAsText();

            if (el[x].isPartial()) {
                holder.setBold(el[x].getStartOffset(), el[x].getEndOffsetInclusive() true);
            } else {
                holder.setBold(true);
            }
        }
    }

```

Translate the selection text

```js
    var selection = DocumentApp.getActiveDocument().getSelection();
    if (!selection) {
        return
    }

    var el = selection.getRangeElements();
    DocumentApp.getUi().alert('Number of selected elements ' + el.length);

    var output = '';

    for (var x = 0; x < el.length; x++) {
        if (el[x].getElement().editAsText) {
            var holder = el[x].getElement().editAsText();
            output += holder.getText();
        }
    }

    var spanish = LanguageApp.translate(output, 'en', 'es');
    DocumentApp.getUi().alert('Translated to Spanish: ' + spanish);
```

Search content and replace

```js
function myFunc1() {
    var body = DocumentApp.getActiveDocument().getBody();
    var ui = DocumentApp.getUi();

    var response = ui.prompt('Search', 'What did you want to find?', ui.ButtonSet.OK_CANCEL);
    if (response.getResponseText()) {
        var replacer = ui.prompt('Replace', 'Replace with what?', ui.ButtonSet.OK_CANCEL);
        body.replaceText(response.getResponseText(), replacer.getResponseText());
    }
}
```

Find content update attributes

```js
function myFunc1() {
    var body = DocumentApp.getActiveDocument().getBody();
    var ui = DocumentApp.getUi();

    var response = ui.prompt('Search', 'What did you want to find?', ui.ButtonSet.OK_CANCEL);
    if (response.getResponseText()) {
        var finderContent = body.findText(response.getResponseText());
        Logger.log(finderContent);

        var foundText = finderContent.getElement().asText();
        Logger.log(foundText);

        var outputContent = finderContent.getElement().editAsText();
        Logger.log(outputContent);

        var startPos = finderContent.getStartOffset();
        var endPos = finderContent.getEndOffsetInclusive();
        outputContent.setForegroundColor(startPos, endPos, '#00FFFF');
    }
}
```

### Content Selection Exercise

Turn selected text to uppercase using `JS method`

```js
function myFunc1() {
    var selection = DocumentApp.getActiveDocument().getSelection();

    if (selection) {
        var el = selection.getRangeElements();

        for (var x = 0; x < el.length; x++) {
            var textSelected = el[x].getElement().editAsText();

            if (el[x].isPartial()) {
                var startPos = el[x].getStartOffset();
                var endPos = el[x].getEndOffsetInclusive();

                var selText = textSelected.getText().substring(startPos, endPos);
                textSelected.deleteText(startPos, endPos);
                textSelected.insertText(startPos, selText.toUpperCase());
            } else {
                textSelected.setText(textSelected.getText().toUpperCase());
            }
        }
    }
}
```

### DocumentApp exercise

Find the word `HELLO` and change it to `HELLO WORLD`

```js
    var doc = DocumentApp.getActiveDocument();
    var body = doc.getBody();
    var finderContent = body.findText('HELLO');

    while (finderContent != null) {
        var outputContent = finderContent.getElement().editAsText();
        var startPos = finderContent.getStartOffset();
        var endPos = finderContent.getEndOffsetInclusive();

        outputContent.insertText(endPos, ' WORLD');
    }
```

### DocumentApp create content

- Create table
- Create paragraph
- Create list items

```js
    var doc = DocumentApp.getActiveDocument();
    var body = doc.getBody();

    var data = [
        ['First row', '2nd column', '3rd column'], 
        ['Second row', '2nd column', '3rd column'], 
        ['Third row', '2nd column', '3rd column']
    ];

    var table = body.appendTable(data);

    var firstRow = table.getRow(0)
    firstRow.editAsText().setBackgroundColor('#ffff00');

    var heading = body.insertParagraph(0, doc.getName());
    heading.setHeading(DocumentApp.ParagraphHeading.HEADING1);

    var listItem1 = body.appendListItem('First Item #1');
    var listItem2 = body.appendListItem('First Item #2');
    var listItem3 = body.appendListItem('First Item #3');
    var listItem4 = listItem1.copy();
    body.appendListItem(listItem4);

    listItem2.clear();
```

### Insert image DocumentApp

```js
    var doc = DocumentApp.getActiveDocument();
    var body = doc.getBody();
    var imageUrl = '';

    var myImage = UrlFetchApp.fetch(imageUrl);

    body.appendImage(myImage.getBlob());
```

### DocumentApp template exercise

```js
    var doc = DocumentApp.getActiveDocument();
    var body = doc.getBody();

    // clear page
    body.clear();

    // insert placeholder
    body.appendParagraph('Welcome to the page, {firstName}');
    body.appendParagraph('Thanks for sharing');
    body.appendParagraph('Ready on {date}');

    // replace placeholder with real data
    body.replaceText('{firstName}', 'Hieu');
    body.replaceText('{date}', Date());
```

## Google Spreadsheet App

[Doc](https://developers.google.com/apps-script/reference/spreadsheet/)

### Standalone spreadsheet app

Create new spreadsheet app

```js
function myFunction() {
  var ss = SpreadsheetApp.create('Test 001');
  Logger.log(ss.getUrl());
}
```

### Create content and styling

Open spreadsheet

- Get range of content using notation `A1`, `B1`,...

```js
function myFunction() {
    var ss = SpreadSheetApp.openById('');
    Logger.log(ss.getName());

    ss.getRange('A1').setBackgrounđ('red');
    ss.getRange('B1').setBackgrounđ('blue');
}
```

- Get range of content using row and column index

```js
function myFunction() {
    var ss = SpreadSheetApp.openById('');
    var sheet = ss.getSheets()[0];

    var range = sheet.getRange(1, 1, 8).setBackground('green');
    var range = sheet.getRange(1, 1, 8, 4).setBackground('yellow');
}
```

- Exercise

```js
// function myFunction() {
//   var ss = SpreadsheetApp.create('Test 001');
//   Logger.log(ss.getUrl());
//   Logger.log(ss.getId());
// }


function myFunction() {
  var ssId = '';
  var ss = SpreadsheetApp.openById(ssId);
  var sheet = ss.getSheets()[0];

  var cell = sheet.getRange('A1');
  cell.setBackground('yellow');

  var square = sheet.getRange(2, 1, 3, 3);
  square.setBackground('orange');
}
```

### Get and set values

```js
function myFunction() {
  var ssId = '';
  var ss = SpreadsheetApp.openById(ssId);
  var sheet = ss.getSheets()[0];

  var cell = sheet.getRange('A1');
  Logger.log(cell.getValue());

  cell.setValue('Hieu Nguyen Trong');
  Logger.log(cell.getValue());
}
```

### Spreadsheet data to Doc table

- Open spreadsheet
- Get values in range
- Create new document
- Write data to new document

```js
function myFunction() {
  var ssId = '16JHeye-uj_zH7t-EWynEeEtz0B5nsLYNlFj0xRL40Jg';
  var ss = SpreadsheetApp.openById(ssId);

  if (!ss) {
    Logger.log('Error when opening spreadsheet');
    return 
  }

  var sheet = ss.getSheets()[0];

  var doc = DocumentApp.create('Export sheets data');
  var body = doc.getBody();
  
  var rowData = sheet.getRange(1, 1, 3, 3).getValues();
  Logger.log('Read spreadsheet data succeed');

  var docHeading = 'Sheet Name: ' + ss.getName();

  body
    .insertParagraph(0, docHeading)
    .setHeading(DocumentApp.ParagraphHeading.HEADING1);

  body
    .insertParagraph(1, 'Exported at: ' + Date()) 
    .appendHorizontalRule();

  var table = body.appendTable(rowData);
  table.getRow(0).editAsText().setBold(true);

  Logger.log('Export success to docs at: ' + doc.getUrl());
}
```

### Spreadsheet data dynamic

- `sheet.getLastRow()`
- `sheet.getLastColumn()`

```js
function myFunction() {
  var ssId = '16JHeye-uj_zH7t-EWynEeEtz0B5nsLYNlFj0xRL40Jg';
  var ss = SpreadsheetApp.openById(ssId);
  var sheet = ss.getSheets()[0];

  var docId = '145l50g7ZclpnfSc3XUDs3ReHcaAl99VyGig_cMc3MO4';
  var doc = DocumentApp.openById(docId);
  var body = doc.getBody();

  body.clear();

  var rowData = sheet
    .getRange(1, 1, sheet.getLastRow(), sheet.getLastColumn())
    .getValues();

  Logger.log(rowData);

  var docHeading = 'Sheet Name: ' + ss.getName();

  body
    .insertParagraph(0, docHeading)
    .setHeading(DocumentApp.ParagraphHeading.HEADING1);

  body
    .insertParagraph(1, 'Exported at: ' + Date()) 
    .appendHorizontalRule();

  var table = body.appendTable(rowData);
  table.getRow(0).editAsText().setBold(true);
}
```

### From one spreadsheet to another

```js
function myFunction() {
  var ssId = '16JHeye-uj_zH7t-EWynEeEtz0B5nsLYNlFj0xRL40Jg';
  var ss = SpreadsheetApp.openById(ssId);

  var sheet1 = ss.getSheets()[1];
  var newSpreadSheet = SpreadsheetApp.create('New');

  sheet1.copyTo(newSpreadSheet);
}
```

### Bound Spreadsheet App

- Get active spreadsheet: `SpreadSheetApp.getActiveSpreadSheet()`
- Get active sheet on the spreadsheet: `activeSpreadSheet.getActiveSheet()`

```js
function myFunction() {
  var ss = SpreadsheetApp.getActiveSpreadsheet();
  var sheet = ss.getActiveSheet();  
}
```

### Create customized function with bound script

- Define customized function
- Enter new formula in SpreadSheet app

```js
function TIMES5(input) {
  return input * 5;
}

function ISEMAIL(input) {
  var re = /\S+@\S+.\S+/;
  return re.test(input);
}
```

### UI menu options

- Inject code to `onOpen` `hook`

```js
function onOpen(e) {
  SpreadsheetApp
    .getUi() 
    .createMenu('Advanced')
    .addItem('Welcome', 'myFunction1')
    .addSeparator()
    .addToUi();
}

function myFunction1() {
  var ui = SpreadsheetApp.getUi();

  var response = ui.prompt('Getting to know you', 'May I know your name?', ui.ButtonSet.YES_NO);
  ui.alert('Hello ' + response.getResponseText());
}
```

Show modal and sidebar

```js
function onOpen(e) {
  SpreadsheetApp
    .getUi() 
    .createMenu('Advanced')
    .addItem('Welcome', 'myFunction1')
    .addSeparator()
    .addItem('Open Modal', 'myFunction2')
    .addItem('Open Sidebar', 'myFunction3')
    .addToUi();
}

function myFunction1() {
  var ui = SpreadsheetApp.getUi();

  var response = ui.prompt('Getting to know you', 'May I know your name?', ui.ButtonSet.YES_NO);
  ui.alert('Hello ' + response.getResponseText());
}

function myFunction2() {
  var ui = SpreadsheetApp.getUi();
  var html = HtmlService
                .createHtmlOutput('<h1>Welcome</h1>')
                .setHeight(400)
                .setWidth(600);
  
  var response = ui.showModalDialog(html, 'Modal popup');
}

function myFunction3() {
  var ui = SpreadsheetApp.getUi();
  var html = HtmlService
                .createHtmlOutput('<h1>Welcome</h1>')
                .setHeight(400)
                .setWidth(600);
  
  var response = ui.showSidebar(html);
}
```

### Get selected content

- Get selected range
- Get values
- Display notation of the selected range

```js
function myFunction() {
    var ss = SpreadsheetApp.getActiveSpreadsheet().getActiveRange();
    ss.getA1Notation();
    ss.getValues();
}
```

### Exercise: Move selected row to another sheet

```js
function onOpen(e) {
  SpreadsheetApp
    .getUi() 
    .addItem('Copy Selected Row', 'myFunction4')
    .addToUi();
}

function myFunction4() {
  var spreadSheet = SpreadsheetApp.getActiveSpreadsheet();
  if (!spreadSheet) {
    return
  }

  var sheet = spreadSheet.getActiveSheet();
  if (!sheet) {
    return
  }

  var sRange = sheet.getActiveRange();
  if (!sRange) {
    return
  }

  var rows = sRange.getValues();
  
  var newSheet = spreadSheet.insertSheet();
  for (var x = 0; x < rows.length; x++) {
    newSheet.appendRow(rows[x]);
  }
}
```

### Communicate between gg sheet client and app script services

```js
// client side

google.script.run.withSuccessHandler(onSuccess).getSheetData(data);

function onSuccess(data) {
    console.log(data);
}
```

```js
// server side | apps script

function getSheetData() {
    return "Data to client";
}
```

### Triggers onEdit or onChange

- Add event handler

```js
function onChange() {
    Logger.log('Changed content');
}

function onEdit() {
    Logger.log('Edited content');
}
```

- Add trigger: go to Apps Script Triggers

## Google Script Sites

### Publish Web App Google Script

- Write `doGet` function

```js
function doGet() {
   return HtmlService.createHtmlOutput('<h1>Hello World</h1>');
}

function doPost() {
   return HtmlService.createHtmlOutput('<h1>Hello World</h1>');  
}
```

- Deploy as Web App
- `{URL}/exec`: prod
- `{URL}/dev`: dev

## Google Drive App

### Google DriveApp Class

It allows you to access and modify files and folders on the Google Drive.

Get list of files in the `root` folder and iterate throught list

```js
function myFunction() {
  var files = DriveApp.getFiles();  
  var temp = [];

  while(files.hasNext()) {
    var file = files.next()
    temp.push(file.getName());
  }

  Logger.log(temp);
}
```

### Select folder by ID

```js
function myFunction() {
  var folder = DriveApp.getFolderById('1s4oDuyNzGx3qlWARDfRgfaQJROeagfOa');
  var files = folder.getFiles();

  var temp = [];
  while(files.hasNext()) {
    var file = files.next();

    temp.push(file.getName());
  }

  Logger.log(temp);
}
```

### Create new stuff

Create new folder

```js
function myFunction() {
  var pFolder = DriveApp.getFolderById('1s4oDuyNzGx3qlWARDfRgfaQJROeagfOa');
  var newFolder = pFolder.createFolder('Test Folder');

  Logger.log(newFolder.getId());
  Logger.log(newFolder.getUrl());
}
```

Create file inside folder

```js
function myFunction() {
  var pFolder = DriveApp.getFolderById('1wetedDBJLVA2Vuiaf74wm1q0kgx95VDl');
  var file = pFolder.createFile('text.txt', 'New Text File', MimeType.PLAIN_TEXT);

  Logger.log(file.getId());
  Logger.log(file.getUrl());
}
```

### List folders and write to sheet

```js
function myFunction() {
  var ss = SpreadsheetApp.openById('1ljBobBqtbXJGfNTNH_KMj7B2yASF342ZnIAuKGC5UII');
  var sheet = ss.getSheets()[0];

  sheet.clear();
  sheet.appendRow(['No.', 'Name', 'ID', 'URL', 'Date Created']);

  var pFolder = DriveApp.getFolderById('1wetedDBJLVA2Vuiaf74wm1q0kgx95VDl');
  var folders = pFolder.getFolders();

  var count = 1;
  while(folders.hasNext()) {
    var folder = folders.next();

    sheet.appendRow([count, folder.getName(), folder.getId(), folder.getUrl(), folder.getDateCreated()]);

    count += 1;
  }

  sheet.appendRow([`Last run on: ${Date()}`]);
}
```

### Create new file and move it

- Default path is `root` folder
- Using GGDrive app to move the file to another folder

```js
function myFunction() {
  var pFolder = DriveApp.getFolderById('1wetedDBJLVA2Vuiaf74wm1q0kgx95VDl');

  var newDocName = 'Test Doc';
  var newDoc = DocumentApp.create(newDocName);
  var newDocId = newDoc.getId();

  newDoc.saveAndClose();

  var file = DriveApp.getFileById(newDocId);

  var rootFolder = file.getParents();
  pFolder.addFile(file);
  rootFolder.next().removeFile(file);
}
```

### Exercise WebApp Redirector

```js
function doGet(e){
  if(typeof e === 'undefined'){
    return false;
  }
  //{parameter={id=test}, contextPath=, contentLength=-1, queryString=id=test, parameters={id=[test]}}
  var searchString = e.parameter.id;
  var itemURL = searchTerm(searchString);
  if(!itemURL){
    return HtmlService.createHtmlOutput('Not Found');
  }else{
    var html = HtmlService.createTemplateFromFile('search');
    html.data = {url:itemURL,term:searchString}
    var output = html.evaluate().setSandboxMode(HtmlService.SandboxMode.IFRAME);
    return output;
  }
}

function searchTerm(s){
  var parFolder = '1Eov0auGT7GS2i1Il0dbdvyqzLr515M1s'; 
  var folder = DriveApp.getFolderById(parFolder);
  var result = folder.searchFolders('title contains "'+s+'"');
  if(result.hasNext()){
    var foundFolder = result.next();
    var folderId = foundFolder.getId();
    var folderURL = foundFolder.getUrl();
    return folderURL;
    
  }
  return false;
  Logger.log(result);
}

<!DOCTYPE html>
<html>
  <head>
    <base target="_top">
    <script>
     var data = <?!= JSON.stringify(data) ?>;
     console.log(data.url);
     function redirector(){
       document.getElementById('message').innerHTML = '<a href="'+data.url+'" target="_blank">'+data.term+'</a>';
     }
     window.onload = redirector;
    </script>
  </head>
  <body>
    <div id="message"></div>
  </body>
</html>
```

## Google GmailApp

### Introduction

Send mail

```js
function myFunction() {
  GmailApp.sendEmail('hieu.ngxtr@gmail.com', 'Test Email', 'Hello World');
}
```

Make draft email

```js
function myFunction() {
  var file = DriveApp.getFileById('');
  var mailObject = {
    attachments: [file.getAs(MimeType.PDF)],
    name: 'My Doc as PDF'
  };

  var toEmail = 'hieu.ngxtr@gmail.com';
  var subject = 'Test Email';
  var content = 'Hello World';

  GmailApp.createDraft(toEmail, subject, content, mailObject);
}
```

Get Draft Email

```js
function myFunction() {
  var drafts = GmailApp.getDrafts();
  
  for (var x = 0; x < drafts.length; x++) {
    Logger.log(drafts[x]);

    var body = drafts[x].getMessage().getBody();
    var subject = drafts[x].getMessage().getSubject();

    Logger.log(body);
    Logger.log(subject);
  }
}
```

Send out a bunch of emails

```js
function myFunction() {
  GmailApp.sendEmail('gappscourses@gmail.com', 'test email', 'Hello World')
}
function makeDraft(){
  var file = DriveApp.getFileById('1tEsnMRa2jRV9S2WzuTV2abpJNrr-s7tohE0gGyRux-A');
  GmailApp.createDraft('gappscourses@gmail.com', 'Test PDF', 'Check out the attachment',{
    attachments: [file.getAs(MimeType.PDF)],
    name:'My Doc as PDF'
  } );
}
function seeDraft(){
  var draft = GmailApp.getDrafts();
  for(var x=0;x<draft.length;x++){
    //draft[x].update('gappscourses@gmail.com', 'Updated '+x, 'Hello world'+x);
    var id = draft[x].getId();
    Logger.log(id)
    Logger.log(draft[x].getMessage().getBody());
    Logger.log(draft[x].getMessage().getSubject());
  }
  Logger.log(draft);
}
function sendHTMLTemp(){
  var emailMessage = HtmlService.createHtmlOutputFromFile('email').getContent();
  emailMessage = emailMessage.replace('#TITLE', 'New String Value');
  emailMessage = emailMessage.replace('#MESSAGE', 'Replaced with new message');
  MailApp.sendEmail('gappscourses@gmail.com', 'New email Temp', '',{
    htmlBody:emailMessage
  })
  Logger.log(emailMessage);
}
function sendTemp(arr,x){
  var emailMessage = HtmlService.createHtmlOutputFromFile('email').getContent();
  emailMessage = emailMessage.replace('#TITLE', 'Bulk Mailer Tester');
  emailMessage = emailMessage.replace('#MESSAGE', arr[3]);
  emailMessage = emailMessage.replace('#FIRST', arr[0]);
  emailMessage = emailMessage.replace('#LAST', arr[1]);
  MailApp.sendEmail(arr[2], 'Email Value'+x, '',{
    htmlBody:emailMessage
  })
  Logger.log(emailMessage);
  return true;
}
function bulkEmails(){
  var sheet = SpreadsheetApp.openById('1IaLf8gt5-BdK_wfLmYW07QXuHFu8QZA3W42vr1mxQLA').getSheetByName('Sheet1');
  var range = sheet.getRange(2,1,sheet.getLastRow()-1,sheet.getLastColumn());
  var value = range.getValues();
  //range.sort({column:1,ascending:true})
  for(var x=0;x<value.length;x++){
   Logger.log(value[x]); 
    var row = 2+x;
    var rep = sendTemp(value[x],x);
    sheet.getRange(row, 5, 1, 2).setValues([[rep,Date()]])
  }
}
<div style="color:red;background:blue;">
<h2>#TITLE</h2>
<hr>
<p>Welcome #FIRST #LAST</p>
<p>#MESSAGE</p>
</div>
```

### Get email messages

```js
function myFunction() {
  GmailApp.sendEmail('gappscourses@gmail.com', 'test email', 'Hello World')
}
function testerLabel(){
  var sheet = SpreadsheetApp.openById('1IaLf8gt5-BdK_wfLmYW07QXuHFu8QZA3W42vr1mxQLA').getSheetByName('Sheet2');
  var tester = GmailApp.getUserLabelByName('tester');
  var added = GmailApp.getUserLabelByName('added');
  var emails = tester.getThreads();
  for(var x=0;x<emails.length;x++){
    var msg = emails[x].getMessages();
    for(var i=0;i<msg.length;i++){
      var message = msg[i].getBody();
      var subject = msg[i].getSubject();
      var dateSent = msg[i].getDate();
      var fromSender = msg[i].getFrom();
      msg[i].star();
      sheet.appendRow([message,subject,dateSent,fromSender]);
      Logger.log(message);
    }
    emails[x].addLabel(added);
    emails[x].removeLabel(tester);
  }
}
function chatThreads(){
  var threads = GmailApp.getChatThreads(0,50);
  Logger.log(threads);
  var emailAddress = Session.getActiveUser().getEmail();
  if(threads.length >0 ){
   GmailApp.sendEmail(emailAddress, 'thread tester', threads[0].getMessageCount());
  }
}
function makeDraft(){
  var file = DriveApp.getFileById('1tEsnMRa2jRV9S2WzuTV2abpJNrr-s7tohE0gGyRux-A');
  GmailApp.createDraft('gappscourses@gmail.com', 'Test PDF', 'Check out the attachment',{
    attachments: [file.getAs(MimeType.PDF)],
    name:'My Doc as PDF'
  } );
}
function seeDraft(){
  var draft = GmailApp.getDrafts();
  for(var x=0;x<draft.length;x++){
    //draft[x].update('gappscourses@gmail.com', 'Updated '+x, 'Hello world'+x);
    var id = draft[x].getId();
    Logger.log(id)
    Logger.log(draft[x].getMessage().getBody());
    Logger.log(draft[x].getMessage().getSubject());
  }
  Logger.log(draft);
}
function sendHTMLTemp(){
  var emailMessage = HtmlService.createHtmlOutputFromFile('email').getContent();
  emailMessage = emailMessage.replace('#TITLE', 'New String Value');
  emailMessage = emailMessage.replace('#MESSAGE', 'Replaced with new message');
  MailApp.sendEmail('gappscourses@gmail.com', 'New email Temp', '',{
    htmlBody:emailMessage
  })
  Logger.log(emailMessage);
}
function sendTemp(arr,x){
  var emailMessage = HtmlService.createHtmlOutputFromFile('email').getContent();
  emailMessage = emailMessage.replace('#TITLE', 'Bulk Mailer Tester');
  emailMessage = emailMessage.replace('#MESSAGE', arr[3]);
  emailMessage = emailMessage.replace('#FIRST', arr[0]);
  emailMessage = emailMessage.replace('#LAST', arr[1]);
  MailApp.sendEmail(arr[2], 'Email Value'+x, '',{
    htmlBody:emailMessage
  })
  Logger.log(emailMessage);
  return true;
}
function bulkEmails(){
  var sheet = SpreadsheetApp.openById('1IaLf8gt5-BdK_wfLmYW07QXuHFu8QZA3W42vr1mxQLA').getSheetByName('Sheet1');
  var range = sheet.getRange(2,1,sheet.getLastRow()-1,sheet.getLastColumn());
  var value = range.getValues();
  //range.sort({column:1,ascending:true})
  for(var x=0;x<value.length;x++){
   Logger.log(value[x]); 
    var row = 2+x;
    var rep = sendTemp(value[x],x);
    sheet.getRange(row, 5, 1, 2).setValues([[rep,Date()]])
  }
}
```

## Calendar App Class

## Image Uploader Project

### HTML content service

Render HTML page (Web client page)

```js
function doGet() {
  var output = '<h1>Hello World</h1>';
  var html = HtmlService.createHtmlOutput(output);
  return html;
}
```

HTML template

```js
function doGet() {
  var template = HtmlService.createTemplate('<?= foo ?>');
  template.foo = 'Hello World###';
  return template.evaluate();
}
```

HTML content from file

```js
function doGet() {
  var output = HtmlService.createHtmlOutputFromFile('index');
  return output;
}
```

HTML template from file

- Template file

```html
<!DOCTYPE html>
<html>
  <head>
    <base target="_top">
  </head>
  <body>
    <h1><?= foo ?></h1>
  </body>
</html>
```

- Script file

```js
function doGet() {
  var template = HtmlService.createTemplateFromFile('index');

  template.foo = 'Hello World!!!';
  return template.evaluate();
}
```

### Create HTML form

### Send data to Google Script Backendo

Using `Client-side API` service

- Add script on the client side

```html
<script>
    var output = document.getElementById('output');

    document.getElementById('btn-submit').addEventListener('click', function(e) {
        e.preventDefault();
        output.innerHTML = 'Clicked';

        // invoke backend function
        const postData = {
            fileName: ''
        };

        google.script.run.doUpload(postData);
    })
</script>
```

- Write handler on server side

```js
function doUpload(postData) {
  Logger.log('Get request');
  Logger.log(postData);
}
```

- Add success handler on the client side

```html
<script>
    var output = document.getElementById('output');

    document.getElementById('btn-submit').addEventListener('click', function(e) {
        e.preventDefault();
        output.innerHTML = 'Clicked';

        // invoke backend function
        const postData = {
            fileName: ''
        };

        google.script.run
            .withSuccessHandler(onSuccess)
            .doUpload(postData);
    });

    function onSuccess(data) {
        output.innerHTML = JSON.stringify(data);
    }
</script>
```

### Send image to Google script

Setup form on client side

```html
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">

      <h1 class="my-5">Image Uploader</h1>

      <form id='form'>
        <div class="mb-3">
          <label for="formFile" class="form-label">Select picture</label>
          <input class="form-control" type="file" id="formFile" name="file">
        </div>
        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
      </form>

      <hr />
      <p id="output"></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
      var output = document.getElementById('output');
      var formEl = document.getElementById('form');

      document.getElementById('btn-submit').addEventListener('click', function(e) {
        e.preventDefault();
        output.innerHTML = 'Clicked';

        // invoke backend function
        google.script.run
          .withSuccessHandler(onSuccess)
          .doUpload(formEl);
      });

      function onSuccess(data) {
        output.innerHTML = JSON.stringify(data);
      }
    </script>
  </body>
</html>
```

Handle save upload image on server side

```js
function doGet() {
  var template = HtmlService.createTemplateFromFile('index');

  template.foo = 'Hello World!!!';
  return template.evaluate();
}

function doUpload(postData) {
  var fileImage = postData.file;
  var folder = DriveApp.getFolderById('1G6A03nit31NfGt7Fb03Nrsp0pBqzswW-');
  var image = folder.createFile(fileImage);

  var response = {
    'url': image.getUrl(),
    'status': 'success'
  };

  return response;
}
```

Tweak client side UI

```html
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">

      <h1 class="my-5">Image Uploader</h1>

      <form id='form'>
        <div class="mb-3">
          <label for="formFile" class="form-label">Select picture</label>
          <input class="form-control" type="file" id="formFile" name="file">
        </div>
        <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
      </form>

      <hr />

      <p id="output"></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
      var output = document.getElementById('output');
      var formEl = document.getElementById('form');

      document.getElementById('btn-submit').addEventListener('click', function(e) {
        e.preventDefault();
        output.innerHTML = 'Uploading...';

        // invoke backend function
        google.script.run
          .withSuccessHandler(onSuccess)
          .doUpload(formEl);
      });

      function onSuccess(data) {
        output.innerHTML = JSON.stringify(data);

        if (data.status === 'success') {
          output.innerHTML = 'Upload succeed';

          var aEl = document.createElement('a');
          aEl.href = data.url;
          aEl.target = 'blank';
          aEl.innerHTML = data.url;

          output.insertAdjacentElement('afterend', aEl);
        }
      }
    </script>
  </body>
</html>
```

### Spreadsheet App tracking uploads

```js
function doGet() {
  var template = HtmlService.createTemplateFromFile('index');

  template.foo = 'Hello World!!!';
  return template.evaluate();
}

function doUpload(postData) {
  // get post data
  var fileImage = postData.file;

  // send file to google drive
  var folder = DriveApp.getFolderById('12ISU6xMfGsDzfSQjBZWeejAqfxcKMAi0');
  var image = folder.createFile(fileImage);

  // tracking upload
  var ss = SpreadsheetApp.openById('1qOUV_6wkJaaC1rK-GMst76xQKa1MnsYxGk1YVyBQSQ4');
  var sheet = ss.getSheetByName('sheet1');
  sheet.appendRow([image.getUrl(), image.getName(), Date()]);

  var response = {
    'url': image.getUrl(),
    'status': 'success'
  };

  return response;
}
```

### Send email notification

```js
function doGet() {
  var template = HtmlService.createTemplateFromFile('index');

  template.foo = 'Hello World!!!';
  return template.evaluate();
}

function doUpload(postData) {
  // get post data
  var fileImage = postData.file;

  // send file to google drive
  var folder = DriveApp.getFolderById('12ISU6xMfGsDzfSQjBZWeejAqfxcKMAi0');
  var image = folder.createFile(fileImage);

  // tracking upload
  var ss = SpreadsheetApp.openById('1qOUV_6wkJaaC1rK-GMst76xQKa1MnsYxGk1YVyBQSQ4');
  var sheet = ss.getSheetByName('sheet1');
  sheet.appendRow([image.getUrl(), image.getName(), Date()]);

  // send notification email
  var recipent = 'hieu.nth999@gmail.com';
  var subject = 'New Image Uploaded';
  var body = HtmlService 
              .createHtmlOutput(`
                <h1>Image uploaded succeed</h1>
                <p>Upload time: ${Date()}</p>
                <p>View at:
                  <a 
                    href="${image.getUrl()}" 
                    target="blank"
                  >
                    ${image.getUrl()}
                  </a>
                </p>
              `)
              .getContent();

  MailApp.sendEmail({
    to: recipent,
    subject: subject,
    htmlBody: body
  });

  // response to client
  var response = {
    'url': image.getUrl(),
    'status': 'success'
  };

  return response;
}
```

## Form auto email responder

### Setup

Overview project:

- Create simple form with email address field
- Link form responses to Google Sheet
- Add trigger and send back notification to the email address when user submitting the form

### Spreadsheet bound script

- Open spreadsheet app
- Create bound script
- Setup trigger handler
- Setup trigger

```js
function onFormSubmit(e) {
  Logger.log('Submitted');
  Logger.log(e);
}
```

Add trigger:

- Choose handler function
- Select event source: From spreadsheet
- Select event type: on form submit

### Setup email to send

```js
function onFormSubmit(e) {
  sendHTMLEmail(e.values);
}

function sendHTMLEmail(data) {
  var emailHTML = HtmlService.createHtmlOutputFromFile('email').getContent();

  var date = data[0];
  var name = data[1];
  var email = data[2];
  var group = data[3];

  emailHTML = emailHTML.replace('#DATE', date);
  emailHTML = emailHTML.replace('#GROUP', group);
  emailHTML = emailHTML.replace('#NAME', name;

  MailApp.sendEmail(email, 'Form notification', '', {
    htmlBody: emailHTML
  });
}
```

### HTML to PDF and attach it

```js
function onFormSubmit(e) {
  sendHTMLEmail(e.values);
}

function sendHTMLEmail(data) {
  var emailHTML = HtmlService.createHtmlOutputFromFile('email').getContent();

  emailHTML = emailHTML.replace('#DATE', data[0]);
  emailHTML = emailHTML.replace('#GROUP', data[3]);
  emailHTML = emailHTML.replace('#NAME', data[1]);

  var blob = HtmlService.createHtmlOutput(emailHTML);
  var pdf = blob.getAs('application/pdf');
  var newName = data[1].replace(/[^A-Z0-9]/ig, '_');
  pdf.setName(newName);

  // DriveApp.createFile(blob);

  MailApp.sendEmail(data[2], 'Form notification', '', {
    htmlBody: emailHTML,
    attachments: [pdf]
  });
}
```

## Contact form

### Setup triggers

```js
function doGet() {
  var now = new Date();
  Logger.log(now.toString());

  return ContentService.createTextOutput(now.toString());
}

function doPost() {
  var now = new Date();
  Logger.log(now.toString());

  return ContentService.createTextOutput(now.toString());
}
```

### Get data parameters

```js
function doGet(e) {
  //  {
  //      parameter={id=1, name=hieu}, 
  //      parameters={name=[hieu], id=[1]}, 
  //      contextPath=, 
  //      contentLength=-1.0, 
  //      queryString=id=1&name=hieu
  //  }

  // https://script.google.com/macros/s/AKfycbxkCIl14Xb2TgzCJLDnuwbAHo9DMvNSxT-E_z07_SuS/dev

  Logger.log(e);
  var obj = {
    params: e.parameter,
    status: 200,
    value: 'Hello World'
  };

  return ContentService.createTextOutput(JSON.stringify(obj));
}

function doPost(e) {
  var now = new Date();
  Logger.log(now.toString());
}
```

### Source

```js
function doPost(e) {
  var ss = SpreadsheetApp.openById('1jMp6UaFJgoKj2a5Wx4_qEj_OphOyxPCtLsONKOtFh10');
  var sheet = ss.getSheets()[0];
  var rows = sheet.getDataRange().getValues();

  // [id, timestamp, name, email, message]
  var headings = rows[0].map(k => k.toLowerCase());

  var holder = [];
  var newId = (new Date().getTime()).toString(36);

  e.parameter.id = newId;
  e.parameter.timestamp = new Date();

  for (var x in headings) {
    var key = headings[x];
    var value = e.parameter[key] || 'none';

    holder.push(value);
  }

  sheet.appendRow(holder);

  var obj = {
    params: e.parameter,
    status: 'success',
    code: 200,
    value: newId
  };

  return ContentService.createTextOutput(JSON.stringify(obj));
}
```
