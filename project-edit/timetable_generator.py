# Timetable Generator using Genetic Algorithm
import random
# Define timetable parameters
DAYS = 5
HOURS = 8
SUBJECTS = ['CNS', 'PEE', 'PROJECT',]
TEACHERS = ['Mr. Viswanathan', 'Ms. joice', 'Ms. Vaishnavi']
ROOMS = ['Room 1', 'Room 2', 'Room 3']
# Generate random timetable
def generate_timetable():
    timetable = {}
    for day in range(DAYS):
        for hour in range(HOURS):
            subject = random.choice(SUBJECTS)
            teacher = random.choice(TEACHERS)
            room = random.choice(ROOMS) 
            timetable[(day, hour)] = {'Subject': subject, 'Teacher': teacher, 'Room': room}
    return timetable

# Evaluation function (fitness function)
def evaluate_timetable(timetable):
# Implement constraints evaluation
# Example: Check teacher availability, room capacity, subject prerequisites
# Return a score indicating the quality of the timetable
    return random.randint(0, 100)


# Genetic Algorithm
def genetic_algorithm():
    population_size = 10
    iterations = 100
    population = [generate_timetable() for _ in range(population_size)]
    for _ in range(iterations):
        population = sorted(population, key=lambda x: evaluate_timetable(x))
        # Implement selection, crossover, mutation
        # Example: Select top performing timetables, perform crossover and mutation
        # Update population with new generation
        best_timetable = population[0]
    return best_timetable

# Main function
def main():
    best_timetable = genetic_algorithm()
    print("Best Timetable:")
    print(best_timetable)
if __name__ == "__main__":
    main()