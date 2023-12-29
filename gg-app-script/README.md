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
    Logger.log('First was run');
}

function myFunc2() {
    Logger.log('First was run');
}

function myFunc3() {
    Logger.log('First was run');
}

function myFunc4() {
    Logger.log('First was run');
}

function myFunc5() {
    Logger.log('First was run');
}
```
