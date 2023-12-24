# 1. Day 2 - Beginner - Understanding data types and how to manipulate strings

## 1.1. Day 2 goals

- Project: Tip calculator

## 1.2. Python primitive data types

- `string`: string of characters
- subscript a string with `[]`: `str[0]`

```py
    print("Hello"[0]) #H
```

- `integer`: whole number, number without decimal places
- Seperate large number with `_`

```py
    a = 123
    b = 345
    print(a + b)

    large_number = 123_456_789
```

- `float`: floating point number, number with decimal places

```py
    pi = 3.14
    print(pi)
```

- `boolean`: logic with 2 values: `True` or `False`

```py
    a = True
    b = False 

    print(a)
    print(b)
```

## 1.3. Type error, Type checking and Type conversion

- Type error: can only concatenate `str` to `str`

```py
    num_char = len(input("What is your name? "))
    print("Your name has " + num_char + " characters.")
```

- Perform type checking with `type` function

```py
    num_char = len(input("What is your name? "))
    print(type(num_char))
```

- Type conversion (type casting), change value from 1 type to another type

```py
    num_char = len(input("What is your name? "))
    new_num_char = str(num_char)
    print("Your name has " + new_num_char + " characters.")
```

- Type conversion, more examples

```py
    a = 123
    print(type(a))

    b = str(a)
    print(type(b))

    c = float(a)
    print(c)
```

## 1.4. Mathematical operations in Python

- Addition: +
- Subtraction: -
- Multiplication: *
- Division: /, result in floating point number
- Exponent: **

The order of mathematical operator execution: `PEMDAS`

- Parentheses
- Exponents
- Multiplication
- Division
- Addition
- Subtraction

## 1.5. Number manipulation and F strings in Python

- To round the number, we use the `round` function

```py
    print(round(8 / 3))
    print(round(8 / 3, 2)) # 2 decimal places
```

- `mod` operator, get only `integer`

```py
    print(8 // 3) # 2
```

- `div` operator

```py
    print(8 % 3) # 2
```

- Using `f-String` to mix strings and different data types

```py
    score = 10
    height = 1.8
    isWinning = True

    print("Your score is " + str(score))

    # f-String
    print(f"Your score is {score}, your height is {height}, you are winning is {isWinning}")
```

## 1.6. Day 2 Project: Tip Calculator

```py
print("Welcome to the Tip Calculator.")

bill = float(input("What was the total bill? $"))
tip = int(input("What percentage tip would you like to give? 10, 12, or 15? "))
people = int(input("How many people to split the bill? "))

bill_with_tip = bill + (bill * (tip / 100))
bill_per_person /= number

final_amount = "{:.2f}".format(bill_per_person)

print(f"Each person should pay: ${final_amount}")
```
