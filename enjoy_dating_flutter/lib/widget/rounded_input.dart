import 'package:flutter/material.dart';

class roundedInput extends StatelessWidget {
  final String placeholder;
  final double paddingVertical;
  final int maxLength;
  final double borderRadius;
  final TextEditingController? controler_;
  final TextInputType? keyboardType;
  final bool? inputEnable;
  final bool? obscuretext;
  final Widget? suffix;
  const roundedInput({Key? key,
    required this.placeholder,
    this.maxLength = 1,
    this.controler_,
    this.obscuretext=false,
    this.inputEnable=true,
    this.paddingVertical = 0,
    this.borderRadius = 30,
    this.suffix,
    this.keyboardType = TextInputType.text
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(

            padding: EdgeInsets.symmetric(vertical: paddingVertical, horizontal: 0),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(borderRadius),
            ),
            child: Column(
              children: [
                TextFormField(
                  keyboardType: keyboardType,
                  enabled: inputEnable,
                  obscureText: !obscuretext!?false:true,
                  controller: controler_,
                  decoration: InputDecoration(
                    fillColor: Color(0xFE4AB5E1),
                    filled: true,
                    focusedBorder: OutlineInputBorder(
                      borderSide: BorderSide(color: Color(0xFECBA7FF), width: 1),
                      borderRadius: BorderRadius.circular(borderRadius),

                    ),
                    border: OutlineInputBorder(
                      borderSide: BorderSide(color: Color(0xFECBA7FF), width: 1),
                      borderRadius: BorderRadius.circular(borderRadius),
                    ),
                    enabledBorder: OutlineInputBorder(
                      borderSide: BorderSide(color: Color(0xFECBA7FF), width: 1),
                      borderRadius: BorderRadius.circular(borderRadius),
                    ),
                    hintText: placeholder,
                    suffixIcon: suffix,
                    hintStyle: TextStyle(color: Color(0xFEFFFFFF).withOpacity(0.8), fontWeight: FontWeight.w300),
                    contentPadding: EdgeInsets.symmetric(vertical: maxLength==1?0:6, horizontal: 16),
                  ),
                  style: TextStyle(color:inputEnable==false?Colors.white60: Colors.white, fontWeight: FontWeight.w400),
                  maxLines: maxLength,
                ),
              ],
            ),
          )
        ],
      ),
    );
  }
}
