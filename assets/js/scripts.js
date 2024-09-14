for (let i = 0; i < 10; i++) {
    if (i === 5) {
        break;
        console.log("This will never be executed"); // Unreachable code
    }
}
public void someMethod() {
    throw new Exception("An error occurred");
    System.out.println("This will never be executed"); // Unreachable code
}
