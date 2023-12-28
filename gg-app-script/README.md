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
