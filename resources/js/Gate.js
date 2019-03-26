export default class Gate {

    constructor(user){
      this.user=user;
    }

    isAdmin(){
      return this.user.type === 'admin';
    }

    isGateEntry(){
      return this.user.type === 'gateEntry';
    }

    isYarnStore(){
      return this.user.type === 'yarnStore';
    }

    isGreyFabric(){
      return this.user.type === 'greyFabric';
    }

    isFinishFabric(){
      return this.user.type === 'finishFabric';
    }

    isDyesAndChemical(){
      return this.user.type === 'dyesAndchemical';
    }

    isTrimsStore(){
      return this.user.type === 'trimsStore';
    }

}
