# 1. Day 1 - Beginner - Working with Variables in Python to Manage data

- [1. Day 1 - Beginner - Working with Variables in Python to Manage data](#1-day-1---beginner---working-with-variables-in-python-to-manage-data)
  - [1.1. Overview](#11-overview)
  - [1.2. Day 1 goals](#12-day-1-goals)
  - [1.3. Printing to the Console in Python](#13-printing-to-the-console-in-python)
  - [1.4. String manipulation and code intelligence](#14-string-manipulation-and-code-intelligence)
  - [1.5. The Python input function](#15-the-python-input-function)
  - [1.6. Thonny application](#16-thonny-application)
  - [1.7. Commenting code](#17-commenting-code)
  - [1.8. Python variables](#18-python-variables)
  - [1.9. Variable naming](#19-variable-naming)
  - [1.10. Project: Band Name Generator](#110-project-band-name-generator)

## 1.1. Overview

- API
- GUI dev
- Web dev
- Data science
- Web scraping
- Python scripting
- Web design
- API

Ways to learn code:

- Step by step video tutorials
- Programming concepts
- Interactive coding exercises
- Real world projects

## 1.2. Day 1 goals

- Printing
- Commenting
- Debugging
- String manipulation
- Variables
- Project: Band name generator

[Source code online](https://replit.com/@appbrewery/band-name-generator-end)

## 1.3. Printing to the Console in Python

```py
print("Hello world!")
```

- `print` function
- `string`: a string of characters
- the `"` shows the beginning and the end of the string of characters

## 1.4. String manipulation and code intelligence

- Use newline character `\n`
- Combine 2 strings using `+` operator

```py
    print("Hello" + " " + "world!")
```

## 1.5. The Python input function

```py
    input("What is your name?")
```

- `input` function: allows user to type some text into our program

## 1.6. Thonny application

See how the computer execute code step by step

## 1.7. Commenting code

```py
    # This is a comment
```

## 1.8. Python variables

- Store something into a variable to refer it later

```py
    name = input("What is your name?")

    # refer to name variable
    print(name)
```

- The variable can be changed

```py
    name = input("What is your name?")

    # refer to name variable
    print(name)

    # change the variable
    name = "Hieu"
    print(name)
```

## 1.9. Variable naming

- Make our code readable
- The name of the variable has to be 1 single unit
- To seperate words in Python, we use the `_`

```py
    user_name = input("What is your name?")
```

## 1.10. Project: Band Name Generator

- User types in the name of the city and the name of their pet
- The program combines those things and print the band name

```py
    print("Welcome to the Band Name Generator.")

    city = input("Which city did your grow up in?\n")
    pet = input("What is the name of a pet?\n")

    band_name = city + " " + pet

    print("Your band name could be " + band_name)
```
