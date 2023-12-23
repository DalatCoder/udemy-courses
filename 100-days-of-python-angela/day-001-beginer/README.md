# Day 1 - Beginner - Working with Variables in Python to Manage data

Overview:

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

## Day 1 goals

- Printing
- Commenting
- Debygging
- String manipulation
- Variables
- Project: Band name generator

[Source code online](https://replit.com/@appbrewery/band-name-generator-end)

## Printing to the Console in Python

```py
print("Hello world!")
```

- `print` function
- `string`: a string of characters
- the `"` shows the beginning and the end of the string of characters

## String manipulation and code intelligence

- Use newline character `\n`
- Combine 2 strings using `+` operator

```py
    print("Hello" + " " + "world!")
```

## The Python input function

```py
    input("What is your name?")
```

- `input` function: allows user to type some text into our program

## Thonny application

See how the computer execute code step by step

## Commenting code

```py
    # This is a comment
```

## Python variables

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

## Variable naming

- Make our code readable
- The name of the variable has to be 1 single unit
- To seperate words in Python, we use the `_`

```py
    user_name = input("What is your name?")
```

## Project: Band Name Generator

- User types in the name of the city and the name of their pet
- The program combines those things and print the band name

```py
    print("Welcome to the Band Name Generator.")

    city = input("Which city did your grow up in?\n")
    pet = input("What is the name of a pet?\n")

    band_name = city + " " + pet

    print("Your band name could be " + band_name)
```
