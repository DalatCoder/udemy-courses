print("Welcome to the Tip Calculator.")

total_bill_str = input("What was the total bill? $")
total_bill = float(total_bill_str)

tip_percentage_str = input("What percentage tip would you like to give? 10, 12, or 15? ")
tip_percentage = int(tip_percentage_str)

people_number_str = input("How many people to split the bill? ")
people_number = int(people_number_str)

result = total_bill + (total_bill * (tip_percentage / 100))
result /= people_number

final_amount = "{:.2f}".format(result)

print(f"Each person should pay: ${final_amount}")
