export class Person{
    constructor(name,lastName,age){
        this.name=name;
        this.lastName=lastName;
        this.age=age
    }

    mostrar(){
        return ` mi nombre es ${this.name} ${this.lastName} y tengo ${this.age} años` ;
    }
}

module.exports=Person;